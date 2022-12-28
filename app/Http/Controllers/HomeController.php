<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function home()
    {
        $users = User::get();
        return view('home', compact('users'));
    }

    public function search(Request $request)
    {
        $search_param = $request->search_param;
        if ($search_param != '') {

            $departments = Department::where('name', 'LIKE', "%{$request->search_param}%")->get();
            $designations = Designation::where('name', 'LIKE', "%{$request->search_param}%")->get();


            $users = User::where(function ($query) use ($departments, $designations, $search_param) {
                $query->where('name', 'LIKE', "%{$search_param}%");
                if ($designations) {
                    foreach ($designations as $designation) {
                        $query->OrwhereRaw("find_in_set('" . $designation->id . "',designation_id)");
                    }
                }
                if ($departments) {
                    foreach ($departments as $department) {
                        $query->OrwhereRaw("find_in_set('" . $department->id . "',department_id)");
                    }
                }
            })->get();
        } else {
            $users = User::get();
        }

        return view('include_users', compact('users'));
    }
}
