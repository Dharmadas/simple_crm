<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\UserUpdateFormRequest;
use App\Role;
use App\Department;
use DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showCreateForm()
    {
        $roles = Role::all();
        $departments = Department::all();
        $users = User::all();

        return view('users.create_form', ['roles' => $roles, 'departments' => $departments, 'users' => $users]);
    }

    public function addData(UserFormRequest $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = bcrypt($request->input('password'));
        $role = $request->input('role');
        $department = $request->input('department');
        $manager = $request->input('manager');
        $user = new User([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role_id' => $role,
            'department_id' => $department,
            'manager_id' => $manager,
        ]);

        try
        {
            $user->save();
            return response()->json(['status' => 'true', 'response' => 'Record created successfully.']);
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => 'false', 'response' => 'Unable to create record.']);
        }

    }

    public function displayList()
    {
        $users = DB::table('users as u')
                    ->join('roles', 'u.role_id', '=', 'roles.id')
                    ->join('departments', 'u.department_id', '=', 'departments.id')
                    ->join('users as m', 'u.manager_id', '=', 'm.id')
                    ->select('u.id','u.name', 'u.email', 'roles.name as role', 'departments.name as department', 'm.name as manager')
                    ->get();
        return view('users.users', ['users' => $users]);

    }

    public function getUsers()
    {
        $query = User::select("name", "email");
        return datatables($query)->make(true);
    }

    public function showUpdateForm($id)
    {
        $roles = Role::all();
        $departments = Department::all();
        $usersList = User::all();

        $user = User::find($id);
        return view('users.update_form', ['user' => $user, 'roles' => $roles, 'departments' => $departments, 'usersList' => $usersList]);
    }

    public function updateData(UserUpdateFormRequest $request)
    {
        $id = $request->input('id');

        $user = User::find($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role_id = $request->input('role');
        $user->department_id = $request->input('department');
        $user->manager_id = $request->input('manager');
        if(!empty($request->input('password'))){
            $user->password = bcrypt($request->input('password'));
        }

        try
        {
            $user->save();
            return response()->json(['status' => 'true', 'response' => 'Record updated successfully.']);
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => 'false', 'response' => 'Unable to update record.']);
        }
    }

    public function showProfile()
    {
        $user_id = Auth::User()->id;
        //$user = User::find($user_id);

        $user = DB::table('users as u')
            ->join('roles', 'u.role_id', '=', 'roles.id')
            ->join('departments', 'u.department_id', '=', 'departments.id')
            ->join('users as m', 'u.manager_id', '=', 'm.id')
            ->where('u.id', '=', $user_id)
            ->select('u.name', 'u.email', 'roles.name as role', 'departments.name as department', 'm.name as manager')
            ->get();

        return view('users.profile', ['user' => $user]);
    }
}
