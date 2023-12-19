<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignSubject;
use App\Models\SchoolSubject;
use App\Models\StudentClass;
class AssignSubjectController extends Controller
{
    public function ViewAssignSubject(){
        // $data['allData'] = AssignSubject::all();
       $data['allData'] = AssignSubject::select('class_id')->groupBy('class_id')->get();
        return view('backend.setup.assign_subject.view_assign_subject', $data);
    }
    public function AddAssignSubject(Request $request){
        $data['subjects'] = SchoolSubject::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.assign_subject.add_assign_subject', $data);
    }
    public function StoreAssignSubject(Request $request){
        $subjectCount = count($request->subject_id);
        if ($subjectCount != NULL) {
            for ($i = 0; $i < $subjectCount; $i++) {
                $assign_subject = new AssignSubject();
                $assign_subject->class_id = $request->class_id;
                $assign_subject->subject_id = $request->subject_id[$i];
                $assign_subject->full_mark = $request->full_mark[$i]; 
                $assign_subject->pass_mark = $request->pass_mark[$i];
                $assign_subject->subjective_mark = $request->subjective_mark[$i];
                $assign_subject->save();
            }
        }
        $notification = array(
            'message' => 'Data Added Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->route('assign.subject.view')->with($notification);
    }
    public function EditAssignSubject($class_id){
        $data['editData'] = AssignSubject::where('class_id', $class_id)->orderBy('subject_id', 'asc')->get();

        //dd($data['editData']->toArray());
 
        $data['subjects'] = SchoolSubject::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.assign_subject.edit_assign_subject', $data);
    }
    public function UpdateAssignSubject(Request $request, $class_id){ 
        if ($request->subject_id == NULL) {
            $notification = array(
                'message' => 'Oops !, you didnt select any subject.',
                'alert-type' => 'error',
            );
            return Redirect()->route('assign.subject.edit', $class_id)->with($notification);
        } 
        else {
            $countClass = count($request->subject_id);

            //delete all previous data with specified id
            AssignSubject::where('class_id', $class_id)->delete();

            //insert new data
            for ($i = 0; $i < $countClass; $i++) {
                $assign_subject = new AssignSubject();
                $assign_subject->class_id = $request->class_id;
                $assign_subject->subject_id = $request->subject_id[$i];
                $assign_subject->full_mark = $request->full_mark[$i]; 
                $assign_subject->pass_mark = $request->pass_mark[$i];
                $assign_subject->subjective_mark = $request->subjective_mark[$i];
                $assign_subject->save();
            }
        }
        $notification = array(
            'message' => 'Data Updated Successfully !',
            'alert-type' => 'success',
        );
        return Redirect()->route('assign.subject.view')->with($notification);
    }
    public function AssignSubjectDetail(Request $request, $class_id){
        $data['detailsData'] = AssignSubject::where('class_id', $class_id)->orderBy('subject_id', 'asc')->get();

        return view('backend.setup.assign_subject.details_assign_subject',$data);
    }
}
