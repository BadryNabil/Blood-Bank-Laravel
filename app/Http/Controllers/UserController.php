<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users=User::paginate(20);
        return view('users.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
           'name'        => 'required',
           'password'    => 'required|confirmed',
           'email'       => 'email',
           'roles_list'  => 'required'
       ]);
      $request->merge(['password'=>bcrypt($request->password)]);
      $user = User::create($request->except('roles_list'));
      $user->roles()->attach($request->input('roles_list'));
      flash()->success('success');
      return redirect(route('users.index'));
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
        $user = User::findOrFail($id);
        return view('users.edit',compact('user'));
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
      $this->validate($request, [
           'name'        => 'required',
           'password'    => 'required|confirmed',
           'email'       => 'email',
           'roles_list'  => 'required'
       ]);
        $record = User::findOrFail($id);
        $record->update($request->all());
        $record->roles()->sync($request->roles_list);
        flash()->success("Edited");
        return redirect(route('users.index',$record->id));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $record = User::findOrFail($id);
      $record->delete();
      flash()->success("Deleted");
      return back();
    }
}
