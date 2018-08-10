<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Campaign;
use App\Http\Requests\GeneralFormRequest;
use Illuminate\Support\Facades\Input;

class CampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showCreateForm()
    {
        return view('campaigns.create_form');
    }

    public function addData(GeneralFormRequest $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $campaign = new Campaign([
            'name' => $name,
            'description' => $description,
        ]);

        try
        {
            $campaign->save();
            return response()->json(['status' => 'true', 'response' => 'Record created successfully.']);
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => 'false', 'response' => 'Unable to create record.']);
        }

    }

    public function displayList()
    {
        $campaigns = Campaign::all();
        return view('campaigns.campaigns', ['campaigns' => $campaigns]);

    }

    public function getCampaigns()
    {
        $query = Campaign::select("name", "description");
        return datatables($query)->make(true);
    }

    public function showUpdateForm($id)
    {
        $disposition = Campaign::find($id);
        return view('campaigns.update_form', ['campaign' => $disposition]);
    }

    public function updateData(GeneralFormRequest $request)
    {
        $id = $request->input('id');
        $campaign = Campaign::find($id);

        $campaign->name = $request->input('name');
        $campaign->description = $request->input('description');

        try
        {
            $campaign->save();
            return response()->json(['status' => 'true', 'response' => 'Record updated successfully.']);
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => 'false', 'response' => 'Unable to update record.']);
        }
    }
}
