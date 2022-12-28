<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //

    public function user()
    {
        $title = 'User';
        $userList = User::get();
        return view('user.list', compact('userList', 'title'));
    }

    public function user_create()
    {
        $key = "Create";
        $title = "Create User";
        $designations = Designation::get();
        $departments = Department::get();
        return view('user.add', compact('key', 'title', 'designations', 'departments'));
    }

    public function user_store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:2|max:191',
            'phone_number' => 'required|min:2|max:191',
            'department' => 'required',
            'designation' => 'required',
        ]);
        $user = new User();
        $user->name = $validatedData['name'];
        $user->phone_number = $validatedData['phone_number'];
        $user->department_id = $validatedData['department'];
        $user->designation_id = $validatedData['designation'];
        if ($user->save()) {
            session()->flash('success', 'User "' . $request->name . '" has been added successfully');
            return redirect('user/');
        } else {
            return back()->with('message', 'Error while creating user');
        }
    }

    public function user_edit($id)
    {
        if ($id > 0) {
            $user = User::find($id);
            $title = 'User Edit';
            $key = 'Edit';
            $designations = Designation::get();
            $departments = Department::get();
            return view('user.add', compact('user', 'title', 'key', 'designations', 'departments'));
        }
    }

    public function user_update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:2|max:191',
            'phone_number' => 'required|min:2|max:191',
            'department' => 'required',
            'designation' => 'required',
        ]);
        $user = User::find($id);
        $user->name = $validatedData['name'];
        $user->phone_number = $validatedData['phone_number'];
        $user->department_id = $validatedData['department'];
        $user->designation_id = $validatedData['designation'];
        $user->updated_at = now();
        if ($user->save()) {
            session()->flash('success', 'User has been updated successfully');
            return redirect('user');
        } else {
            return back()->with('error', 'Error while updating user');
        }
    }
}
