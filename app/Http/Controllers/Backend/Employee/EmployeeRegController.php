<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\StudentYear;
use App\Models\User;
use App\Models\EmployeeSalaryLog;
use App\Models\Designation;
use DB;
use PDF;

class EmployeeRegController extends Controller
{
    public function EmployeeRegView()
    {
        $data['allData'] = User::where('usertype', 'Employee')->get();
        return view('backend.employee.employee_reg.employee_view', $data);
    }
    public function EmployeeRegAdd(Request $request){
        $data['designation']=Designation::all();

        return view('backend.employee.employee_reg.employee_add',$data);  
    }
    public function EmployeeRegStore(Request $request){
        DB::transaction(function () use ($request) {
            $checkYear = date('Ym',strtotime($request->join_date));
            $employee = User::where('usertype', 'Employee')->orderBy('id', 'DESC')->first();
            if ($employee == NULL) {
                $fistReg = 0;
                $employeeId = $fistReg + 1;
                if ($employeeId < 10) {
                    $id_no = '000' . $employeeId;
                } else if ($employeeId < 100) {
                    $id_no = '00' . $employeeId;
                } else if ($employeeId < 1000) {
                    $id_no = '0' . $employeeId;
                }
            } else {
                $employee = User::where('usertype', 'Student')->orderBy('id', 'DESC')->first()->id;
                $employeeId = $employee + 1;

                if ($employeeId < 10) {
                    $id_no = '000' . $employeeId;
                } else if ($employeeId < 100) {
                    $id_no = '00' . $employeeId;
                } else if ($employeeId < 1000) {
                    $id_no = '0' . $employeeId;
                }
            }
            $final_id_no = $checkYear . $id_no;

            $user = new User();
            $code = rand(0000, 9999);

            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->usertype = 'Employee';
            $user->code = $code;
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->salary = $request->salary;
            $user->designation_id = $request->designation_id;
            $user->join_date = date('y-m-d', strtotime($request->join_date));
            $user->dob = date('y-m-d', strtotime($request->dob));

            if ($request->file('image')) {
                $file = $request->file('image');
                // @unlink(public_path('upload/user_images/'.$data->image));
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/employee_images/'), $filename);

                $user['image'] = $filename;
            }
            $user->save();

            $employee_salary = new EmployeeSalaryLog();
            $employee_salary->employee_id = $user->id;
            $employee_salary->effected_salary=date('y-m-d', strtotime($request->join_date));
            $employee_salary->previous_salary = $request->salary;
            $employee_salary->present_salary = $request->salary;
            $employee_salary->increment_salary = '0';
            $employee_salary->save();

      
        });
        $notification = array(
            'message' => 'Employee Added Successfully !',
            'alert-type' => 'success',
        );
        return Redirect()->route('employee.registration.view')->with($notification);
    }//end of method
    public function EmployeeRegEdit($id){
        $data['editData']=User::find($id);
        $data['designation']=Designation::all();
        return view('backend.employee.employee_reg.employee_edit',$data);
    }
    public function EmployeeRegUpdate(Request $request,$id){
    
            $user =  User::find($id);
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->designation_id = $request->designation_id;
            $user->dob = date('y-m-d', strtotime($request->dob));

            if ($request->file('image')) {
                $file = $request->file('image');
               @unlink(public_path('upload/employee_images/'.$user->image));
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/employee_images/'), $filename);

                $user['image'] = $filename;
            }
            $user->save();

        $notification = array(
            'message' => 'Employee updated Successfully !',
            'alert-type' => 'success',
        );
        return Redirect()->route('employee.registration.view')->with($notification);
    } //END METHOD
    public function EmployeeRegDetails($id){
        $data['details']=User::find($id);

        $pdf = PDF::loadView('backend.employee.employee_reg.employee_details_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
