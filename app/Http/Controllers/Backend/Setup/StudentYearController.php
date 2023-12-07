<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentYear;
class StudentYearController extends Controller
{
    public function ViewYear(){
        $data['allData']=StudentYear::all();
         return view('backend.setup.year.view_year',$data);
    }
    public function AddYear(){
        return view('backend.setup.year.add_year');
     }
     public function StudentYearStore(Request $request){
        $validation=$request->validate([
            'name'=>'required|unique:student_years,name',
           ]);

        $data= new StudentYear();
        $data->name=$request->name;
        $data->save();

        $notification=array(
            'message'=>'Student Year Added Successfully',
            'alert-type'=>'success',
            );
            return Redirect()->route('student.year.view')->with($notification);
    }
    public function StudentYearEdit($id){
        $editData=StudentYear::find($id);
        return view('backend.setup.year.edit_year',compact('editData'));
    }
    public function StudentYearUpdate(Request $request,$id){
        $validation=$request->validate([
            'name'=>'required|unique:student_years,name',
           ]);

           $data=StudentYear::find($id);
           $data->name=$request->name;
           $data->save();
   
           $notification=array(
           'message'=>'Year Updated Successfully !',
           'alert-type'=>'success',
           );
           return Redirect()->route('student.year.view')->with($notification);
    }
    
    public function StudentYearDelete(Request $request, $id){
        $data=StudentYear::findOrFail($id);
        $data->delete();

        $notification=array(
            'message'=>'Year Deleted Successfully !',
            'alert-type'=>'info',
            );
            return Redirect()->route('student.year.view')->with($notification);
    }
}
