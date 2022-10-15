<?php

namespace App\Http\Controllers;

use App\Mail\InviteCreated;
use App\Models\Invite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class InviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $invite = Invite::where(['token' => $request->token, 'email' => $request->email])->first();
        if (!$invite) abort(404);
        return view('invite.index');
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

        $invite = Invite::where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();

        if (!$invite) abort(404);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        User::create([
            'email' => $request->email,
            'name' => $request->name,
            'organization_id' => $invite->organization_id,
            'password' => Hash::make($request->password)
        ]);

        $invite->delete();

        return redirect('/login');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function process(Request $request)
    {
        DB::beginTransaction();

        try {
            $organization = Auth::user()->organization;
            do {
                $token = Str::random(16);
            } while (Invite::where('token', $token)->first());

            $invite = Invite::create([
                'email' => $request->email,
                'token' => $token,
                'organization_id' => $organization->id
            ]);

            Mail::to($request->email)->send(new InviteCreated($invite, $organization));
            DB::commit();

            return Redirect::back()->with('status', 'Send email successfuly!');
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
    }
}
