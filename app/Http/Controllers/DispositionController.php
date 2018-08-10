<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Disposition;
use App\Http\Requests\GeneralFormRequest;
use Illuminate\Support\Facades\Input;

class DispositionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showCreateForm()
    {
        return view('dispositions.create_form');
    }

    public function addData(GeneralFormRequest $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $role = new Disposition([
            'name' => $name,
            'description' => $description,
        ]);

        try
        {
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
        $dispositions = Disposition::all();
        return view('dispositions.dispositions', ['dispositions' => $dispositions]);

    }

    public function getDispositions()
    {
        $query = Disposition::select("name", "description");
        return datatables($query)->make(true);
    }

    public function showUpdateForm($id)
    {
        $disposition = Disposition::find($id);
        return view('dispositions.update_form', ['disposition' => $disposition]);
    }

    public function updateData(GeneralFormRequest $request)
    {
        $id = $request->input('id');
        $disposition = Disposition::find($id);

        $disposition->name = $request->input('name');
        $disposition->description = $request->input('description');
        
        try
        {
            $disposition->save();
            return response()->json(['status' => 'true', 'response' => 'Record updated successfully.']);
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => 'false', 'response' => 'Unable to update record.']);
        }
    }
}
