<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentShift;

class StudentShiftController extends Controller
{
    public function ViewShift(){
        $data['allData']=StudentShift::all();
        return view('backend.setup.shift.view_shift',$data);
    }
    public function AddShift(){
        return view('backend.setup.shift.add_shift');
    }
    public function StudentShiftStore(Request $request){
        $validation=$request->validate([
            'name'=>'required|unique:student_shifts,name',
           ]);

        $data= new StudentShift();
        $data->name=$request->name;
        $data->save();

        $notification=array(
            'message'=>'Student Shift Added Successfully',
            'alert-type'=>'success',
            );
            return Redirect()->route('student.shift.view')->with($notification);
    }
    public function StudentShiftEdit($id){
        $editData=StudentShift::find($id);
        return view('backend.setup.shift.edit_shift',compact('editData'));
    }
    public function StudentShiftUpdate(Request $request,$id)
    {
        $validation=$request->validate([
            'name'=>'required|unique:student_shifts,name',
           ]);

           $data=StudentShift::find($id);
           $data->name=$request->name;
           $data->save();
   
           $notification=array(
           'message'=>'Shift Updated Successfully !',
           'alert-type'=>'success',
           );
           return Redirect()->route('student.shift.view')->with($notification);
    }
    public function StudentShiftDelete(Request $request,$id){
        $data=StudentShift::findOrFail($id);
        $data->delete();
    
        $notification=array(
            'message'=>'Shift Deleted Successfully !',
            'alert-type'=>'info',
            );
            return Redirect()->route('student.shift.view')->with($notification);
    }
}
