<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamType;

class ExamTypeController extends Controller
{
    public function ExamTypeView()
    {
        $data['allData'] = ExamType::all();
        return view('backend.setup.exam_type.view_exam_type', $data);
    }
    public function ExamTypeAdd()
    {
        return view('backend.setup.exam_type.add_exam_type');
    }
    public function ExamTypeStore(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|unique:exam_types,name',
        ]);

        $data = new ExamType();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Exam Type Added Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->route('exam.type.view')->with($notification);
    }
    public function ExamTypeEdit($id){
        $editData=ExamType::find($id);
        return view('backend.setup.exam_type.edit_exam_type',compact('editData'));
    }
    public function ExamTypeUpdate(Request $request,$id){
        $validation=$request->validate([
            'name'=>'required|unique:exam_types,name',
           ]);

           $data=ExamType::find($id);
           $data->name=$request->name;
           $data->save();
   
           $notification=array(
           'message'=>'Exam Type Updated Successfully !',
           'alert-type'=>'success',
           );
           return Redirect()->route('exam.type.view')->with($notification);
    }
    public function ExamTypeDelete(Request $request,$id){
        $data=ExamType::findOrFail($id);
        $data->delete();
    
        $notification=array(
            'message'=>'Exam Type Deleted Successfully !',
            'alert-type'=>'info',
            );
            return Redirect()->route('exam.type.view')->with($notification);
    }

}

