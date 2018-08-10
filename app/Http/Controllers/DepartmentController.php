<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests\GeneralFormRequest;
use App\Department;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showCreateForm()
    {
        return view('departments.create_form');
    }

    public function addData(GeneralFormRequest $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $departments = new Department([
            'name' => $name,
            'description' => $description
        ]);

        try
        {
            $departments->save();
            return response()->json(['status' => 'true', 'response' => 'Record created successfully.']);
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => 'false', 'response' => 'Unable to create record.']);
        }

    }

    public function displayList()
    {
        $departments = Department::all();
        return view('departments.departments', ['departments' => $departments]);
    }

    public function getDepartments()
    {
        $query = Department::select("name", "description");
        return datatables($query)->make(true);
    }

    public function showUpdateForm($id)
    {
        $department = Department::find($id);
        return view('departments.update_form', ['department' => $department]);
    }

    public function updateData(GeneralFormRequest $request)
    {
        $id = $request->input('id');
        $department = Department::find($id);

        $department->name = $request->input('name');
        $department->description = $request->input('description');

        try
        {
            $department->save();
            return response()->json(['status' => 'true', 'response' => 'Record updated successfully.']);
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => 'false', 'response' => 'Unable to update record.']);
        }
    }
}
