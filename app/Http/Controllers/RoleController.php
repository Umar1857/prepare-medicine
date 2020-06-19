<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(20);
        return view('backend.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('backend.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name'=>'required|unique:roles,name',
            'permissions'=>'nullable',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validate);
        }

        $role = Role::create(['name' => $request->name]);

        if (!empty($request->permissions)) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('role.index')->withSuccess('Role has been Added Successfully!!');
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
        $role = Role::findById($id);
        $permissions = Permission::all();

        return view('backend.role.edit', compact('role', 'permissions'));
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
        $validate = Validator::make($request->all(),[
            'name'=>'required',
            'permissions'=>'nullable',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validate);
        }

        $role = Role::findById($id);
        $role->name = $request->name;
        $role->save();

        if (!empty($request->permissions)) {

            /* Revoke Previous Permissions */
            /* Add New Permissions */
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('role.index')->withSuccess('Role has been Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();

        return redirect()->route('role.index')->withSuccess('Role has been Deleted Successfully!!');
    }
}
