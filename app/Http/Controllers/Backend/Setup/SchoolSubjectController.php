<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\SchoolSubject;
use Illuminate\Http\Request;

class SchoolSubjectController extends Controller
{
    public function SchoolSubjectView(){
        $data['allData'] = SchoolSubject::all();
        return view('backend.setup.school_subject.view_school_subject', $data);
    }
    public function SchoolSubjectAdd(){
        return view('backend.setup.school_subject.add_school_subject');
    }
    public function SchoolSubjectStore(Request $request){
        $validation = $request->validate([
            'name' => 'required|unique:school_subjects,name',
        ]);

        $data = new SchoolSubject();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Subject Added Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->route('school.subject.view')->with($notification);
    }
    public function SchoolSubjectEdit($id){
        $editData=SchoolSubject::find($id);
        return view('backend.setup.school_subject.edit_school_subject',compact('editData'));
    }
    public function SchoolSubjectUpdate(Request $request,$id){
        $validation=$request->validate([
            'name'=>'required|unique:school_subjects,name',
           ]);

           $data=SchoolSubject::find($id);
           $data->name=$request->name;
           $data->save();
   
           $notification=array(
           'message'=>'Subject Updated Successfully !',
           'alert-type'=>'success',
           );
           return Redirect()->route('school.subject.view')->with($notification);
    }
    public function SchoolSubjectDelete(Request $request,$id){
        $data=SchoolSubject::findOrFail($id);
        $data->delete();
    
        $notification=array(
            'message'=>'Subject Deleted Successfully !',
            'alert-type'=>'info',
            );
            return Redirect()->route('school.subject.view')->with($notification);
    }

}
