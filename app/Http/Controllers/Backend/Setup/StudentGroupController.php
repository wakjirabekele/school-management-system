<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentGroup;

class StudentGroupController extends Controller
{
    public function ViewGroup(){
        $data['allData']=StudentGroup::all();
        return view('backend.setup.group.view_group',$data);
    }
    public function AddGroup(){
        return view('backend.setup.group.add_group'); 
    }
    public function StudentGroupStore(Request $request){
        $validation=$request->validate([
            'name'=>'required|unique:student_groups,name',
           ]);

        $data= new StudentGroup();
        $data->name=$request->name;
        $data->save();

        $notification=array(
            'message'=>'Student Group Added Successfully',
            'alert-type'=>'success',
            );
            return Redirect()->route('student.group.view')->with($notification);
    }
    public function StudentGroupEdit($id){
        $editData=StudentGroup::find($id);
        return view('backend.setup.group.edit_group',compact('editData'));
    }
    public function StudentGroupUpdate(Request $request,$id){
        $validation=$request->validate([
            'name'=>'required|unique:student_groups,name',
           ]);

           $data=StudentGroup::find($id);
           $data->name=$request->name;
           $data->save();
   
           $notification=array(
           'message'=>'Group Updated Successfully !',
           'alert-type'=>'success',
           );
           return Redirect()->route('student.group.view')->with($notification);
    }
   public function StudentGroupDelete(Request $request, $id){
    $data=StudentGroup::findOrFail($id);
    $data->delete();

    $notification=array(
        'message'=>'Group Deleted Successfully !',
        'alert-type'=>'info',
        );
        return Redirect()->route('student.group.view')->with($notification);
    }
}
