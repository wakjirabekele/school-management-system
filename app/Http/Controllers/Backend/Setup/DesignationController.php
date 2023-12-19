<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function ViewDesignation()
    {
        $data['allData'] = Designation::all();
        return view('backend.setup.designation.view_designation', $data);
    }
    public function AddDesignation(Request $request)
    {
        return view('backend.setup.designation.add_designation');
    }
    public function StoreDesignation(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|unique:designations,name',
        ]);

        $data = new Designation();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Designation Added Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->route('designation.view')->with($notification);
    }
    public function EditDesignation(Request $request, $id)
    {
        $editData = Designation::find($id);
        return view('backend.setup.designation.edit_designation', compact('editData'));
    }
    public function UpdateDesignation(Request $request, $id)
    {
        $validation = $request->validate([
            'name' => 'required|unique:designations,name',
        ]);

        $data = Designation::find($id);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Designation Updated Successfully !',
            'alert-type' => 'success',
        );
        return Redirect()->route('designation.view')->with($notification);
    }
    public function DeleteDesignation(Request $request, $id)
    {
        $data = Designation::findOrFail($id);
        $data->delete();

        $notification = array(
            'message' => 'Designation Deleted Successfully !',
            'alert-type' => 'info',
        );
        return Redirect()->route('designation.view')->with($notification);
    }
}


