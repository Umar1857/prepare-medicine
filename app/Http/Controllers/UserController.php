<?php

namespace App\Http\Controllers;

use App\country;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('backend.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = country::all();
        $roles = Role::all();
        return view('backend.user.create', compact('countries', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'first_name'=>'required',
            'second_name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password' => 'nullable|min:8|confirmed',
            'school_name' => 'required',
            'gender' => 'required',
            'country' => 'required',
            'role' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validate);
        }

        /* First Create User */
        $user = new User();
        $user->f_name = $request->first_name;
        $user->s_name = $request->second_name;
        $user->email = $request->email;
        $user->school = $request->school_name;
        $user->gender = $request->gender;
        $user->country = $request->country;
        $user->password = $request->password ? Hash::make($request->password) : Hash::make('12345678');
        $user->expeir_date = date('Y-m-d');
        $user->save();

        /* Now Assign Role */
        $role = Role::findById($request->role);
        $user->assignRole($role);

        return redirect()->route('user.index')->withSuccess('User has been Added Successfully!!');
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
        $user = User::find($id);
        $countries = country::all();
        $roles = Role::all();

        return view('backend.user.edit', compact('user', 'countries', 'roles'));
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
        $validate = Validator::make($request->all(), [
            'first_name'=>'required',
            'second_name'=>'required',
            'email'=>'required|email',
            'password' => 'nullable|min:8|confirmed',
            'school_name' => 'required',
            'gender' => 'required',
            'country' => 'required',
            'role' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validate);
        }

        /* First Create User */
        $user = User::find($id);
        $user->f_name = $request->first_name;
        $user->s_name = $request->second_name;
        $user->email = $request->email;
        $user->school = $request->school_name;
        $user->gender = $request->gender;
        $user->country = $request->country;
        if (!empty($request->password)) {
            $user->password = $request->password ? Hash::make($request->password) : Hash::make('12345678');
        }
        $user->expeir_date = date('Y-m-d');
        $user->save();

        /* Now Assign Role */
        $role = Role::findById($request->role);
        $user->syncRoles($role);

        return redirect()->route('user.index')->withSuccess('User has been Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('user.index')->withSuccess('User has been Deleted Successfully!!');
    }
}
