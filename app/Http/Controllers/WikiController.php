<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Wiki;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class WikiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $project = Project::where('key', $request->key)->first();
        if(!$project) abort(404);
        $pages = Wiki::where('project_id', $project->id)->paginate(15);
        return view('wiki.index', [
            'pages' => $pages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($key)
    {
        //
        $project = Project::where('key', $key)->first();
        if(!$project) abort(404);
        return view('wiki.new', [
            'project' => $project
        ]);
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
        $project = Project::findOrFail($request->project_id);
        if(!$project) abort(404);
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $wiki = new Wiki();
        $wiki->name = $request->name;
        $wiki->content = $request->content;
        $wiki->created_by = Auth::user()->id;
        $wiki->project_id = $request->project_id;
        $wiki->save();

        return Redirect::route('project-page', [
            'key' => $project->key
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($project_id, $id)
    {
        $wiki = Wiki::findOrFail($id);
        return view('wiki.show', [
            'page' => $wiki
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($project_id, $page_id)
    {
        $wiki = Wiki::findOrFail($page_id);
        return view('wiki.edit', [
            'page' => $wiki
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
        $wiki = Wiki::findOrFail($id);
        $wiki->name = $request->name;
        $wiki->content = $request->content;
        $wiki->save();

        return redirect()->back()->with('status', 'Update Success !!');
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
}
