<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\TaskFiles;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class TaskFileController extends Controller
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
        $files = [];
        if($request->hasFile('files')){
            $files = $this->uploadFileToS3($request);
        }
        
        if(count($files) > 0) {
            foreach ($files as $file) {
                $taskfile = new TaskFiles();
                $taskfile->file_id = $file->id;
                $taskfile->task_id = $request->task_id;
                $taskfile->save();
            }
        }
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

    public function uploadFileToS3($request)
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
            $file->project_id = $request->project_id;
            $file->save();

            $uploads[] = $file;
        }

        return $uploads;
    }
}
