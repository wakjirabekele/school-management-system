<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;


class StudentClassController extends Controller
{
    public function ViewStudent(){
        $data['allData']=StudentClass::all();
         return view('backend.setup.student_class.view_class',$data);
    }
    public function AddClassStudent(){
       return view('backend.setup.student_class.add_class');
    }
    public function StudentClassStore(Request $request){
        $validation=$request->validate([
            'name'=>'required|unique:student_classes,name',
           ]);

        $data= new StudentClass();
        $data->name=$request->name;
        $data->save();

        $notification=array(
            'message'=>'Student Class Added Successfully',
            'alert-type'=>'success',
            );
            return Redirect()->route('student.class.view')->with($notification);

    }
    public function StudentClassEdit($id)
    {
        $editData=StudentClass::find($id);
        return view('backend.setup.student_class.edit_class',compact('editData'));
    }
    public function StudentClassUpdate(Request $request,$id){
        $validation=$request->validate([
            'name'=>'required|unique:student_classes,name',
           ]);

           $data=StudentClass::find($id);
           $data->name=$request->name;
           $data->save();
   
           $notification=array(
           'message'=>'Class Updated Successfully !',
           'alert-type'=>'success',
           );
           return Redirect()->route('student.class.view')->with($notification);
    }
    public function StudentClassDelete(Request $request, $id){
        $data=StudentClass::findOrFail($id);
        $data->delete();

        $notification=array(
            'message'=>'Class Deleted Successfully !',
            'alert-type'=>'info',
            );
            return Redirect()->route('student.class.view')->with($notification);
    }
}
