<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return Redirect::route('workspace');
    }

    public function workspace()
    {
        $organization_id = Auth::user()->organization_id;
        $projects = Project::where('organization_id', $organization_id)->orderBy('created_at', 'desc')->get();
        return view('workspace.index', [
            'projects' => $projects
        ]);
    }
}
