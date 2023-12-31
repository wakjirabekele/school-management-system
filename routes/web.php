<?php

use App\Http\Controllers\Backend\Account\AccountSalaryController;
use App\Http\Controllers\Backend\Account\StudentFeeController;
use App\Http\Controllers\Backend\DefaultController;
use App\Http\Controllers\Backend\Employee\EmployeeAttendanceController;
use App\Http\Controllers\Backend\Employee\EmployeeLeaveController;
use App\Http\Controllers\Backend\Employee\EmployeeRegController;
use App\Http\Controllers\Backend\Employee\EmployeeSalaryController;
use App\Http\Controllers\Backend\Employee\MonthlySalaryController;
use App\Http\Controllers\Backend\Marks\GradeController;
use App\Http\Controllers\Backend\Marks\MarksController;
use App\Http\Controllers\Backend\Setup\AssignSubjectController;
use App\Http\Controllers\Backend\Setup\SchoolSubjectController;

use App\Http\Controllers\Backend\student\ExamFeeController;
use App\Http\Controllers\Backend\Student\MonthlyFeeController;
use App\Http\Controllers\Backend\Student\RegistrationFeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Setup\ExamTypeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\FeeAmountController;
use App\Http\Controllers\Backend\Setup\DesignationController;

use App\Http\Controllers\Backend\Student\StudentRegController;
use App\Http\Controllers\Backend\Student\StudentRoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});
Route::get('/admin/logout', [AdminController::class, 'Logout'])->name('admin.logout');


Route::group(['middleware' => 'auth'], function () {

    //Manage All Users

    Route::prefix('users')->group(function () {
        Route::get('/view', [UserController::class, 'UserView'])->name('user.view');
        Route::get('/add', [UserController::class, 'UserAdd'])->name('users.add');
        Route::post('/store', [UserController::class, 'UserStore'])->name('users.store');
        Route::get('/edit/{id}', [UserController::class, 'UserEdit'])->name('users.edit');
        Route::post('/update/{id}', [UserController::class, 'UserUpdate'])->name('users.update');
        Route::get('/delete/{id}', [UserController::class, 'UserDelete'])->name('users.delete');


    });

    //user profile and change password
    Route::prefix('profile')->group(function () {
        Route::get('/view', [ProfileController::class, 'ProfileView'])->name('profile.view');
        Route::get('/edit', [ProfileController::class, 'ProfileEdit'])->name('profile.edit');
        Route::post('/store', [ProfileController::class, 'ProfileStore'])->name('profile.store');
        Route::get('/password/view', [ProfileController::class, 'PasswordView'])->name('password.view');
        Route::post('/password/update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');
    });
    //setup management
    Route::prefix('setups')->group(function () {

        //student class route
        Route::get('/student/class/view', [StudentClassController::class, 'ViewStudent'])->name('student.class.view');
        Route::get('/student/class/add', [StudentClassController::class, 'AddClassStudent'])->name('student.class.add');
        Route::post('/student/class/store', [StudentClassController::class, 'StudentClassStore'])->name('store.student.class');

        Route::get('/student/class/edit/{id}', [StudentClassController::class, 'StudentClassEdit'])->name('student.class.edit');

        Route::post('/student/class/update/{id}', [StudentClassController::class, 'StudentClassUpdate'])->name('update.student.class');

        Route::get('/student/class/delete/{id}', [StudentClassController::class, 'StudentClassDelete'])->name('student.class.delete');

        //student year route
        Route::get('/student/year/view', [StudentYearController::class, 'ViewYear'])->name('student.year.view');
        Route::get('/student/year/add', [StudentYearController::class, 'AddYear'])->name('student.year.add');
        Route::post('/student/year/store', [StudentYearController::class, 'StudentYearStore'])->name('store.student.year');
        Route::get('/student/year/edit/{id}', [StudentYearController::class, 'StudentYearEdit'])->name('student.year.edit');

        Route::post('/student/year/update/{id}', [StudentYearController::class, 'StudentYearUpdate'])->name('update.student.year');
        Route::get('/student/year/delete/{id}', [StudentYearController::class, 'StudentYearDelete'])->name('student.year.delete');

        //student group route
        Route::get('/student/group/view', [StudentGroupController::class, 'ViewGroup'])->name('student.group.view');
        Route::get('/student/group/add', [StudentGroupController::class, 'AddGroup'])->name('student.group.add');
        Route::post('/student/group/store', [StudentGroupController::class, 'StudentGroupStore'])->name('store.student.group');

        Route::get('/student/group/edit/{id}', [StudentGroupController::class, 'StudentGroupEdit'])->name('student.group.edit');

        Route::post('/student/group/update/{id}', [StudentGroupController::class, 'StudentGroupUpdate'])->name('update.student.group');
        Route::get('/student/group/delete/{id}', [StudentGroupController::class, 'StudentGroupDelete'])->name('student.group.delete');

        //student shift route
        Route::get('/student/shift/view', [StudentShiftController::class, 'ViewShift'])->name('student.shift.view');

        Route::get('/student/shift/add', [StudentShiftController::class, 'AddShift'])->name('student.shift.add');
        Route::post('/student/shift/store', [StudentShiftController::class, 'StudentShiftStore'])->name('store.student.shift');
        Route::get('/student/shift/edit/{id}', [StudentShiftController::class, 'StudentShiftEdit'])->name('student.shift.edit');
        Route::post('/student/shift/update/{id}', [StudentShiftController::class, 'StudentShiftUpdate'])->name('update.student.shift');
        Route::get('/student/shift/delete/{id}', [StudentShiftController::class, 'StudentShiftDelete'])->name('student.shift.delete');

        //student fee route
        Route::get('/fee/category/view', [FeeCategoryController::class, 'FeeCategoryView'])->name('fee.category.view');
        Route::get('/fee/category/add', [FeeCategoryController::class, 'FeeCategoryAdd'])->name('student.fee_category.add');
        Route::post('/fee/category/store', [FeeCategoryController::class, 'StoreFeeCategory'])->name('store.fee.category');
        Route::get('/fee/category/edit/{id}', [FeeCategoryController::class, 'EditFeeCategory'])->name('fee.category.edit');
        Route::post('/fee/category/update/{id}', [FeeCategoryController::class, 'UpdateFeeCategory'])->name('update.fee.category');
        Route::get('/fee/category/delete/{id}', [FeeCategoryController::class, 'FeeCategoryDelete'])->name('fee.category.delete');

        //student fee amount route
        Route::get('/fee/amount/view', [FeeAmountController::class, 'FeeAmountView'])->name('fee.amount.view');
        Route::get('/fee/amount/add', [FeeAmountController::class, 'AddFeeAmount'])->name('fee.amount.add');
        Route::post('/fee/amount/store', [FeeAmountController::class, 'StoreFeeAmount'])->name('store.fee.amount');

        Route::get('fee/amount/edit/{fee_category_id}', [FeeAmountController::class, 'FeeAmountEdit'])->name('fee.amount.edit');
        Route::post('fee/amount/update/{fee_category_id}', [FeeAmountController::class, 'UpdateFeeAmount'])->name('update.fee.amount');

        Route::get('fee/amount/details/{fee_category_id}', [FeeAmountController::class, 'FeeAmountDetails'])->name('fee.amount.details');

        //Exam Type route
        Route::get('exam/type/view', [ExamTypeController::class, 'ExamTypeView'])->name('exam.type.view');

        Route::get('exam/type/add', [ExamTypeController::class, 'ExamTypeAdd'])->name('exam.type.add');
        Route::post('exam/type/store', [ExamTypeController::class, 'ExamTypeStore'])->name('store.exam.type');
        Route::get('exam/type/edit/{id}', [ExamTypeController::class, 'ExamTypeEdit'])->name('exam.type.edit');
        Route::post('exam/type/update/{id}', [ExamTypeController::class, 'ExamTypeUpdate'])->name('update.exam.type');
        Route::get('exam/type/delete/{id}', [ExamTypeController::class, 'ExamTypeDelete'])->name('exam.type.delete');

        //school subject route
        Route::get('school/subject/view', [SchoolSubjectController::class, 'SchoolSubjectView'])->name('school.subject.view');
        Route::get('school/subject/add', [SchoolSubjectController::class, 'SchoolSubjectAdd'])->name('school.subject.add');
        Route::post('school/subject/store', [SchoolSubjectController::class, 'SchoolSubjectStore'])->name('store.school.subject');
        Route::get('school/subject/edit/{id}', [SchoolSubjectController::class, 'SchoolSubjectEdit'])->name('school.subject.edit');

        Route::post('school/subject/update/{id}', [SchoolSubjectController::class, 'SchoolSubjectUpdate'])->name('update.school.subject');

        Route::get('school/subject/delete/{id}', [SchoolSubjectController::class, 'SchoolSubjectDelete'])->name('school.subject.delete');

        //Assign subject route
        Route::get('assign/subject/view', [AssignSubjectController::class, 'ViewAssignSubject'])->name('assign.subject.view');
        Route::get('assign/subject/add', [AssignSubjectController::class, 'AddAssignSubject'])->name('assign.subject.add');
        Route::post('assign/subject/store', [AssignSubjectController::class, 'StoreAssignSubject'])->name('store.assign.subject');
        Route::get('assign/subject/edit/{class_id}', [AssignSubjectController::class, 'EditAssignSubject'])->name('assign.subject.edit');

        Route::post('assign/subject/update/{class_id}', [AssignSubjectController::class, 'UpdateAssignSubject'])->name('update.assign.subject');

        Route::get('assign/subject/details/{class_id}', [AssignSubjectController::class, 'AssignSubjectDetail'])->name('assign.subject.details');

        //Designation route
        Route::get('designation/view', [DesignationController::class, 'ViewDesignation'])->name('designation.view');
        Route::get('designation/add', [DesignationController::class, 'AddDesignation'])->name('designation.add');
        Route::post('designation/store', [DesignationController::class, 'StoreDesignation'])->name('store.designation');
        Route::get('designation/edit/{id}', [DesignationController::class, 'EditDesignation'])->name('designation.edit');

        Route::post('designation/update/{id}', [DesignationController::class, 'UpdateDesignation'])->name('update.designation');

        Route::get('designation/delete/{id}', [DesignationController::class, 'DeleteDesignation'])->name('designation.delete');

    });

    //Student registration route
    Route::prefix('students')->group(function () {
        Route::get('/reg/view', [StudentRegController::class, 'StudentRegView'])->name('student.registration.view');
        Route::get('/reg/add', [StudentRegController::class, 'StudentRegAdd'])->name('student.registration.add');
        Route::post('/reg/store', [StudentRegController::class, 'StudentRegStore'])->name('store.student.registration');
        Route::get('/year/class/wise', [StudentRegController::class, 'StudentClassYearWise'])->name('student.year.class.wise');
        Route::get('/reg/edit/{student_id}', [StudentRegController::class, 'StudentRegEdit'])->name('student.registration.edit');
        Route::post('/reg/update/{student_id}', [StudentRegController::class, 'StudentRegUpdate'])->name('update.student.registration');
        Route::get('/reg/promote/{student_id}', [StudentRegController::class, 'StudentRegPromotion'])->name('student.registration.promotion');
        Route::post('/reg/promote/{student_id}', [StudentRegController::class, 'StudentUpdatePromote'])->name('promotion.student.registration');
        Route::get('/reg/details/{student_id}', [StudentRegController::class, 'StudentRegDetails'])->name('student.registration.details');

        //student role generate
        Route::get('/role/generate/view', [StudentRoleController::class, 'StudentRollView'])->name('roll.generate.view');
        Route::get('/reg/getstudents', [StudentRoleController::class, 'GetStudents'])->name('student.registration.getstudents');
        Route::post('/roll/generate/store', [StudentRoleController::class, 'StudentRollStore'])->name('roll.generate.store');

        //Registration fee route
        Route::get('/reg/fee/view', [RegistrationFeeController::class, 'RegFeeView'])->name('registration.fee.view');
        Route::get('/reg/fee/classwisedata', [RegistrationFeeController::class, 'RegFeeClassData'])->name('student.registration.fee.classwise.get');
        Route::get('/reg/fee/payslip', [RegistrationFeeController::class, 'RegFeePayslip'])->name('student.registration.fee.payslip');

        //Monthly fee route
        Route::get('/monthly/fee/view', [MonthlyFeeController::class, 'MonthlyFeeView'])->name('monthly.fee.view');
        Route::get('/monthly/fee/classwisedata', [MonthlyFeeController::class, 'MonthlyFeeClassData'])->name('student.monthly.fee.classwise.get');
        Route::get('/monthly/fee/payslip', [MonthlyFeeController::class, 'MonthlyFeePayslip'])->name('student.monthly.fee.payslip');
        //Exam fee route
        Route::get('/exam/fee/view', [ExamFeeController::class, 'ExamFeeView'])->name('exam.fee.view');
        Route::get('/exam/fee/classwisedata', [ExamFeeController::class, 'ExamFeeClassData'])->name('student.exam.fee.classwise.get');

        Route::get('/exam/fee/payslip', [ExamFeeController::class, 'ExamFeePayslip'])->name('student.exam.fee.payslip');

    });
    //Employee registration route
    Route::prefix('employees')->group(function () {
        Route::get('/reg/view', [EmployeeRegController::class, 'EmployeeRegView'])->name('employee.registration.view');
        Route::get('/reg/add', [EmployeeRegController::class, 'EmployeeRegAdd'])->name('employee.registration.add');
        Route::post('/reg/store', [EmployeeRegController::class, 'EmployeeRegStore'])->name('store.employee.registration');
        Route::get('/reg/edit/{id}', [EmployeeRegController::class, 'EmployeeRegEdit'])->name('employee.registration.edit');
        Route::post('/reg/update/{id}', [EmployeeRegController::class, 'EmployeeRegUpdate'])->name('update.employee.registration');
        Route::get('/reg/details/{id}', [EmployeeRegController::class, 'EmployeeRegDetails'])->name('employee.registration.details');
        
        //Employee salary route
      
        Route::get('/salary/view', [EmployeeSalaryController::class, 'EmployeeSalaryView'])->name('employee.salary.view');
        Route::get('/salary/increment/{id}', [EmployeeSalaryController::class, 'EmployeeSalaryIncrement'])->name('employee.salary.increment');
        Route::post('/salary/employee/increment/{id}', [EmployeeSalaryController::class, 'UpdateIncrementStore'])->name('update.increment.store');
        Route::get('/salary/employee/details/{id}', [EmployeeSalaryController::class, 'EmployeeSalaryDetails'])->name('employee.salary.details');

        //Employee leave route
        Route::get('/leave/view', [EmployeeLeaveController::class, 'EmployeeLeaveView'])->name('employee.leave.view');
        Route::get('/leave/add', [EmployeeLeaveController::class, 'EmployeeLeaveAdd'])->name('employee.leave.add');
        Route::post('/leave/store', [EmployeeLeaveController::class, 'EmployeeLeaveStore'])->name('store.employee.leave');
        Route::get('/leave/edit/{id}', [EmployeeLeaveController::class, 'EmployeeLeaveEdit'])->name('employee.leave.edit');
        Route::post('/leave/update/{id}', [EmployeeLeaveController::class, 'EmployeeLeaveUpdate'])->name('update.employee.leave');
        Route::get('/leave/delete/{id}', [EmployeeLeaveController::class, 'EmployeeLeaveDelete'])->name('employee.leave.delete');
        
        //Employee attendance route
        Route::get('/attendance/view', [EmployeeAttendanceController::class, 'EmployeeAttendanceView'])->name('employee.attendance.view');
        Route::get('/attendance/add', [EmployeeAttendanceController::class, 'EmployeeAttendanceAdd'])->name('employee.attendance.add');
        Route::post('/attendance/store', [EmployeeAttendanceController::class, 'EmployeeAttendanceStore'])->name('store.employee.attendance');
        Route::get('/attendance/edit/{date}', [EmployeeAttendanceController::class, 'EmployeeAttendanceEdit'])->name('employee.attendance.edit');
        Route::get('/attendance/details/{date}', [EmployeeAttendanceController::class, 'EmployeeAttendanceDetails'])->name('employee.attendance.details');
        //Employee monthly salary  route
        Route::get('/monthly/salary', [MonthlySalaryController::class, 'MonthlySalaryView'])->name('employee.monthly.salary');
        Route::get('/monthly/salary/get', [MonthlySalaryController::class, 'MonthlySalaryGet'])->name('employee.monthly.salary.get');
        Route::get('/monthly/salary/slip/{employee_id}', [MonthlySalaryController::class, 'MonthlySalaryPayslip'])->name('employee.monthly.salary.payslip');
        
        
    });
    //mark entry route
    Route::prefix('marks')->group(function () {
        Route::get('/mark/entry/Add', [MarksController::class, 'MarksAdd'])->name('marks.entry.add');
        Route::get('/mark/entry/edit', [MarksController::class, 'MarksEdit'])->name('marks.entry.edit');
        Route::post('/mark/entry/store', [MarksController::class, 'MarksStore'])->name('marks.entry.store');
        Route::get('/mark/getstudents/edit', [MarksController::class, 'MarksEditGetStudents'])->name('student.edit.getstudents');
        Route::post('/mark/entry/update', [MarksController::class, 'MarksUpdate'])->name('marks.entry.update');
        
        //Grade management route
        Route::get('/mark/grade/view', [GradeController::class, 'MarksGradeView'])->name('marks.entry.grade');
        Route::get('/mark/grade/add', [GradeController::class, 'MarksGradeAdd'])->name('marks.grade.add');
        Route::post('/mark/grade/store', [GradeController::class, 'MarksGradeStore'])->name('store.marks.grade');
        Route::get('/mark/grade/edit/{id}', [GradeController::class, 'MarksGradeEdit'])->name('marks.grade.edit');
        Route::post('/mark/grade/update/{id}', [GradeController::class, 'MarksGradeUpdate'])->name('update.marks.grade');
        
    });
    Route::get('/mark/getsubject', [DefaultController::class, 'GetSubject'])->name('marks.getsubject');
    Route::get('/mark/getstudentmarks', [DefaultController::class, 'GetStudents'])->name('student.marks.getstudents');

    //Account managements route
    Route::prefix('accounts')->group(function () {
        Route::get('/students/fee/view', [StudentFeeController::class, 'StudentFeeView'])->name('student.fee.view');
        Route::get('/students/fee/add', [StudentFeeController::class, 'StudentFeeAdd'])->name('student.fee.add');

        Route::get('/students/fee/getstudent', [StudentFeeController::class, 'StudentFeeGetStudent'])->name('account.fee.getstudent');
        
        Route::post('/students/fee/store', [StudentFeeController::class, 'StudentFeeStore'])->name('account.fee.store');

        //employee salary route
        Route::get('/account/salary/view', [AccountSalaryController::class, 'AccountSalaryView'])->name('account.salary.view');
        Route::get('/account/salary/add', [AccountSalaryController::class, 'AccountSalaryAdd'])->name('account.salary.add');
        Route::get('/account/salary/getemployee', [AccountSalaryController::class, 'AccountSalaryGetEmployee'])->name('account.salary.getemployee');

        Route::post('/account/salary/store', [AccountSalaryController::class, 'AccountSalaryStore'])->name('account.salary.store');
        
    });

    
    

}); //end middleware auth