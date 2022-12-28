<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Designation;
class DesignationController extends Controller
{
    //

    public function designation()
    {
        $title = 'Designation';
        $designationList = Designation::get();
        return view('designation.list', compact('designationList', 'title'));
    }

    public function designation_create()
    {
        $key = "Create";
        $title = "Create Designation";
        return view('designation.add', compact('key', 'title',));
    }

    public function designation_store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:2|max:191',
        ]);
        $designation = new Designation();
        $designation->name = $validatedData['name'];
        if ($designation->save()) {
            session()->flash('success', 'Designation "' . $request->name . '" has been added successfully');
            return redirect('designation/');
        } else {
            return back()->with('message', 'Error while creating designation');
        }
    }

    public function designation_edit($id)
    {
        if ($id > 0) {
            $designation = Designation::find($id);
            $title = 'Designation Edit';
            $key = 'Edit';
            return view('designation.add', compact('designation', 'title', 'key'));
        }
    }

    public function designation_update(Request $request,$id){
        $validatedData = $request->validate([
            'name' => 'required|min:2|max:191',
        ]);
        $designation=Designation::find($id);
        $designation->name=$validatedData['name'];
        $designation->updated_at = now();
        if ($designation->save()) {
            session()->flash('success', 'Designation has been updated successfully');
            return redirect('designation');
        } else {
            return back()->with('error', 'Error while updating designation');
        }

    }




}
