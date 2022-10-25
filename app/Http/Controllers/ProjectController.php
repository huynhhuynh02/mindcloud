<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $organization_id = Auth::user()->organization_id;
        $user_id = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'key' => 'required|unique:projects|max:255'
        ]);

        if ($validator->fails()) {
            return redirect('your-work')
                ->withErrors($validator)
                ->withInput();
        }
        $project = new Project();
        $project->name = $request->name;
        $project->key = $request->key;
        $project->description = $request->description;
        $project->organization_id = $organization_id;
        $project->created_by = $user_id;
        $project->save();
        //add task type
        $this->addTaskType($project->id);

        return redirect('your-work')->with('status', 'Project created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function addTaskType($id)
    {
        $tasktype = [
            [
                'name' => 'Task',
                'project_id' => $id,
            ],
            [
                'name' => 'Bug',
                'project_id' => $id,
            ],
            [
                'name' => 'Request',
                'project_id' => $id,
            ],
            [
                'name' => 'Other',
                'project_id' => $id,
            ],
        ];

        TaskType::insert($tasktype);
    }

    public function board(Request $request)
    {
        $project = Project::where('key', $request->key)->first();

        $opens = Task::where([
            'status' => 0,
            'project_id' => $project->id
        ])->get();

        $inprocess = Task::where([
            'status' => 1,
            'project_id' => $project->id
        ])->get();

        $resolves = Task::where([
            'status' => 2,
            'project_id' => $project->id
        ])->get();

        $closes = Task::where([
            'status' => 3,
            'project_id' => $project->id
        ])->get();

        return view('project.board', [
            'opens' => $opens,
            'inprocess' => $inprocess,
            'resolves' => $resolves,
            'closes' => $closes,
            'count_open' => $opens ? count($opens) : 0 ,
            'count_inprocess' => $inprocess ? count($inprocess) : 0,
            'count_resolve' => $resolves ? count($resolves) : 0,
            'count_close' => $closes ? count($closes) : 0
        ]);
    }

    public function ganttChart(Request $request)
    {
        return view('project.gantt');
    }

    public function ganttApi(Request $request)
    {
        $project = Project::where('key', $request->key)->first();
        $tasks = Task::where('project_id', $project->id)->get();

        return response() -> json([
            'data' => $tasks
        ]);
    }
    
}
