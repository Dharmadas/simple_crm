<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use App\Http\Requests\GeneralFormRequest;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showCreateForm()
    {
        return view('permissions.create_form');
    }

    public function addData(GeneralFormRequest $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $permission = new Permission([
            'name' => $name,
            'description' => $description,
        ]);

        try
        {
            $permission->save();
            return response()->json(['status' => 'true', 'response' => 'Record created successfully.']);
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => 'false', 'response' => 'Unable to create record.']);
        }

    }

    public function displayList()
    {
        $permissions = Permission::all()->sortBy('name');
        return view('permissions.permissions', ['permissions' => $permissions]);

    }

    public function getRoles()
    {
        $query = Permission::select("name", "description");
        return datatables($query)->make(true);
    }
}
