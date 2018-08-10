<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\BusinessUnit;
use App\Http\Requests\GeneralFormRequest;
use Illuminate\Support\Facades\Input;
use Gate;

class BusinessUnitController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showCreateForm()
    {
        return view('business_units.create_form');
    }

    public function addData(GeneralFormRequest $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $business_unit = new BusinessUnit([
            'name' => $name,
            'description' => $description
        ]);

        try
        {
            $business_unit->save();
            return response()->json(['status' => 'true', 'response' => 'Record created successfully.']);
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => 'false', 'response' => 'Unable to create record.']);
        }

    }

    public function displayList()
    {
        
        if(Gate::allows('role_access', 'view_business_unit')){
            
            $business_units = BusinessUnit::all();
            return view('business_units.business_units', ['business_units' => $business_units]);
        }
    }

    public function getBusinessUnits()
    {
        $query = BusinessUnit::select("name", "description");
        return datatables($query)->make(true);
    }

    public function showUpdateForm($id)
    {
        $business_unit = BusinessUnit::find($id);
        return view('business_units.update_form', ['business_unit' => $business_unit]);
    }

    public function updateData(GeneralFormRequest $request)
    {
        $id = $request->input('id');
        $business_unit = BusinessUnit::find($id);

        $business_unit->name = $request->input('name');
        $business_unit->description = $request->input('description');

        try
        {
            $business_unit->save();
            return response()->json(['status' => 'true', 'response' => 'Record updated successfully.']);
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => 'false', 'response' => 'Unable to update record.']);
        }
    }
}
