<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskAssignees;
use App\Models\TaskFiles;
use App\Models\TaskType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $project = Project::where('key', $request->key)->first();
        if(!$project) {
            abort(404);
        }

        $tasks = Task::where('project_id', $project->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('task.index', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $organization_id = Auth::user()->organization_id;
        $project = Project::where('key', $request->key)->first();
        if(!$project) {
            abort(404);
        }

        $tasktypes = TaskType::where('project_id', $project->id)->get();
        $users = User::where('organization_id', $organization_id)->get();

        return view('task.new', ['users' => $users, 'tasktypes' => $tasktypes, 'project' => $project]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $organization_id = Auth::user()->organization_id;
            $files = [];
            $user_id = Auth::user()->id;
            $validator = Validator::make($request->all(), [
                'text' => 'required|max:255'
            ]);
     
            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $project = Project::findOrFail($request->project_id);
            if(!$project) {
                abort(404);
            }
            if($request->hasFile('files')){
                $files = $this->uploadFileToS3($request, $project);
            }
            
            $task = new Task();
            $task->text = $request->text;
            $task->description = $request->description;
            $task->project_id = $project->id;
            $task->task_type_id = $request->type;
            $task->status = $request->status;
            if($request->has('end_date')) {
                $task->end_date = $request->end_date;
            }
            $task->start_date = Carbon::now();
            $task->created_by = $user_id;
            $task->save();
            
            if(count($files) > 0) {
                foreach ($files as $file) {
                    $taksfiles = new TaskFiles();
                    $taksfiles->task_id = $task->id;
                    $taksfiles->file_id = $file->id;
                    $taksfiles->save();
                }
            }
    
            $taskassignee = new TaskAssignees();
            $taskassignee->user_id = $request->assignee;
            $taskassignee->task_id = $task->id;
            $taskassignee->save();

            DB::commit();
            return Redirect::route('task-lists', $project->key);

        } catch (\Throwable $th) {
            DB::rollBack();
            return Redirect::back()->with('error', 'An error has occurred, please contact the administrator');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $organization_id = Auth::user()->organization_id;
        $project = Project::where(['key' => $request->key, 'organization_id' => $organization_id])->first();
        if(!$project) {
            abort(404);
        }

        $task = Task::findOrFail($request->task_id);
        if(!$task) {
            abort(404);
        }
        $users = User::where('organization_id', $organization_id)->get();

        return view('task.show', [
            'task' => $task,
            'users' => $users
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $organization_id = Auth::user()->organization_id;
        $project = Project::where(['key' => $request->key, 'organization_id' => $organization_id])->first();
        if(!$project) {
            abort(404);
        }

        $task = Task::findOrFail($request->task_id);
        if(!$task) {
            abort(404);
        }
        $users = User::where('organization_id', $organization_id)->get();
        $tasktypes = TaskType::where('project_id', $project->id)->get();

        return view('task.edit', [
            'project' => $project,
            'task' => $task,
            'users' => $users,
            'tasktypes' => $tasktypes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($request->project_id);

        $task = Task::findOrFail($id);
        if ($task) {
            $task->text = $request->text;
            $task->description = $request->description;
            $task->created_by = Auth::user()->id;
            $task->task_type_id = $request->type;
            $task->status = $request->status;
            if($request->has('end_date')) {
                $task->end_date = $request->end_date;
            }
            $task->save();
            
            return Redirect::route('task-lists', $project->key);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadFileToS3($request, $project)
    {
        $s3 = Storage::disk('s3');
        $uploads = [];

        $files = $request->file('files');
        foreach ($files as $file) {
            $file_name = $file->getClientOriginalName();
            $file_ext = $file->getClientOriginalExtension();
            $file_size = $file->getSize();
            $path = $s3->putFileAs('upload', new File($file), $file_name);
            $file = new Files();
            $file->name = $file_name;
            $file->ext = $file_ext;
            $file->size = $file_size;
            $file->url = 'http://s3-ap-northeast-1.amazonaws.com/'.env('AWS_BUCKET').'/'.$path;
            $file->project_id = $project->id;
            $file->save();

            $uploads[] = $file;
        }

        return $uploads;
    }
}
