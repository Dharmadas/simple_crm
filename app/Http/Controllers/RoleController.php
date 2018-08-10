<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Role;
use App\Http\Requests\GeneralFormRequest;
use Illuminate\Support\Facades\Input;
use App\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showCreateForm()
    {
        $permissions = Permission::all();
        return view('roles.create_form', ['permissions' => $permissions]);
    }

    public function addData(GeneralFormRequest $request)
    {
        try
        {
            $name = $request->input('name');
            $description = $request->input('description');
            $permissions = implode(",", $request->input('permissions'));

            $role = new Role([
                'name' => $name,
                'description' => $description,
                'permissions' => $permissions,
            ]);

            $role->save();
            return response()->json(['status' => 'true', 'response' => 'Record created successfully.']);
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => 'false', 'response' => 'Unable to create record.']);
        }

    }

    public function displayList()
    {
        $roles = Role::all();
        return view('roles.roles', ['roles' => $roles]);

    }

    public function getRoles()
    {
        $query = Role::select("name", "description");
        return datatables($query)->make(true);
    }

    public function showUpdateForm($id)
    {
        $permissions = Permission::all()->sortBy('name');
        $role = Role::find($id);
        $rolePermissions = explode(",", $role->permissions);
        return view('roles.update_form', ['role' => $role, 'permissions' => $permissions, 'rolePermissions' => $rolePermissions]);
    }

    public function updateData(GeneralFormRequest $request)
    {
        $id = $request->input('id');
        $permissions = implode(",", $request->input('permissions'));
        $role = Role::find($id);

        $role->name = $request->input('name');
        $role->description = $request->input('description');
        $role->permissions = $permissions;

        try
        {
            $role->save();
            return response()->json(['status' => 'true', 'response' => 'Record updated successfully.']);
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => 'false', 'response' => 'Unable to update record.']);
        }
    }
}
