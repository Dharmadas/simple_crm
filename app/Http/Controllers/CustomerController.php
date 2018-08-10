<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Customer;
use App\CustomerLog;
use App\BusinessUnit;
use App\Campaign;
use DB;
use App\Http\Requests\CustomerFormRequest;
use App\Disposition;
use App\UserUpdate;
use Illuminate\Support\Facades\Input;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showCreateForm()
    {
        $business_units = BusinessUnit::all();
        $campaigns = Campaign::all();
        $dispositions = Disposition::all();

        return view('customers.create_form', ['business_units' => $business_units, 'campaigns' => $campaigns, 'dispositions' => $dispositions]);
    }

    public function addData(CustomerFormRequest $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $business_unit = $request->input('business_unit');
        $campaign = $request->input('campaign');
        $disposition = $request->input('disposition');
        $message = $request->input('message');
        $user = \Auth::user();

        $customer = new Customer([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'business_unit_id' => $business_unit,
            'campaign_id' => $campaign,
            'user_id' => $user->id,
        ]);

        $userUpdate = new UserUpdate([
            'user_id' => $user->id,
            'disposition_id' => $disposition,
            'message' => $message,
        ]);

        try
        {
            //$customer->save();
            DB::transaction(function() use ($customer, $userUpdate) {

                $customer->save();

                /*
                 * insert new record for user update
                 */
                $userUpdate->customer_id = $customer->id;
                $userUpdate->save();
            }, 4);
            return response()->json(['status' => 'true', 'response' => 'Record created successfully.']);

        }
        catch (\Exception $e)
        {
            return response()->json(['status' => 'false', 'response' => 'Unable to create record.']);
        }

    }

    public function displayList()
    {
        //$roles = Customer::all();
        return view('customers.customers');

    }

    public function getCustomers()
    {
        $query = $query = Customer::select("id", "name", "email", "phone");

        return datatables($query)->make(true);
    }

    public function displayUpdates($id)
    {
        $customers = DB::table('customers')
                        ->join('users', 'customers.user_id', '=', 'users.id')
                        ->join('business_units', 'customers.business_unit_id', '=', 'business_units.id')
                        ->join('campaigns', 'customers.campaign_id', '=', 'campaigns.id')
                        ->where('customers.id', $id)
                        ->select('customers.id','customers.name', 'customers.email', 'customers.phone', 'users.name as creator', 'business_units.name as business_unit', 'campaigns.name as campaign')
                        ->get();
        $userUpdates = DB::table('user_updates')
                        ->join('users', 'user_updates.user_id', '=', 'users.id')
                        ->join('dispositions', 'user_updates.disposition_id', '=', 'dispositions.id')
                        ->where('user_updates.customer_id', $id)
                        ->select('user_updates.user_id', 'user_updates.message', 'users.name as user_name', 'dispositions.name as disposition', 'user_updates.created_at')
                        ->orderBy('user_updates.id', 'desc')
                        ->get();
        $dispositions = Disposition::all();

        if($customers->isEmpty()){
            return view('home');
        }else{
            return view('customers.updates', ['customers' => $customers, 'userUpdates' => $userUpdates, 'dispositions' => $dispositions]);
        }

    }

    public function showUpdateForm($id)
    {
        $customer = Customer::find($id);
        return view('customers.update_form', ['customer' => $customer]);
    }

    public function updateData(CustomerFormRequest $request)
    {
        $id = $request->input('id');
        $customer = Customer::find($id);

        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->phone = $request->input('phone');

        try
        {
            $customer->save();
            return response()->json(['status' => 'true', 'response' => 'Record updated successfully.']);
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => 'false', 'response' => 'Unable to update record.']);
        }
    }

    public function addUpdate(Request $request)
    {
        $customer = $request->input('customer');
        $user = \Auth::User()->id;
        $disposition = $request->input('disposition');
        $message = $request->input('message');

        $userUpdate = new UserUpdate([
            'customer_id' => $customer,
            'user_id' => $user,
            'disposition_id' => $disposition,
            'message' => $message,
        ]);

        try{
            $userUpdate->save();
            return response()->json(['status' => 'true', 'response' => 'Record created successfully.']);
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => 'false', 'response' => 'Unable to create record.']);
        }
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('customerData');
        if(!empty($searchTerm)){
            $data = Customer::where('name', 'like', $searchTerm .'%')
                ->orWhere('email', 'like', $searchTerm .'%')
                ->orWhere('phone', 'like', $searchTerm .'%')
                ->get();
            return view('customers.search', ['searchTerm' => $searchTerm, 'customers' => $data]);
        }else{
            return redirect('customers');
        }
    }
}
