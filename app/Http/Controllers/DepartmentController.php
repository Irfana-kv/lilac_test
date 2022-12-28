<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    //

    public function department()
    {
        $title = 'Department';
        $departmentList = Department::get();    
        return view('department.list', compact('departmentList', 'title'));
    }

    public function department_create()
    {
        $key = "Create";
        $title = "Create Department";
        return view('department.add', compact('key', 'title',));
    }

    public function department_store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:2|max:191',
        ]);
        $department = new Department();
        $department->name = $validatedData['name'];
        if ($department->save()) {
            session()->flash('success', 'Department "' . $request->name . '" has been added successfully');
            return redirect('department/');
        } else {
            return back()->with('message', 'Error while creating department');
        }
    }

    public function department_edit($id)
    {
        if ($id > 0) {
            $department = Department::find($id);
            $title = 'Department Edit';
            $key = 'Edit';
            return view('department.add', compact('department', 'title', 'key'));
        }
    }

    public function department_update(Request $request,$id){
        $validatedData = $request->validate([
            'name' => 'required|min:2|max:191',
        ]);
        $department=Department::find($id);
        $department->name=$validatedData['name'];
        $department->updated_at = now();
        if ($department->save()) {
            session()->flash('success', 'Department has been updated successfully');
            return redirect('department');
        } else {
            return back()->with('error', 'Error while updating department');
        }

    }
}
