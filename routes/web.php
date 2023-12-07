<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\FeeAmountController;
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
Route::get('/admin/logout',[AdminController::class,'Logout'])->name('admin.logout');

//Manage All Users

Route::prefix('users')->group(function(){
    Route::get('/view',[UserController::class,'UserView'])->name('user.view');
    Route::get('/add',[UserController::class,'UserAdd'])->name('users.add');
    Route::post('/store',[UserController::class,'UserStore'])->name('users.store');
    Route::get('/edit/{id}',[UserController::class,'UserEdit'])->name('users.edit');
    Route::post('/update/{id}',[UserController::class,'UserUpdate'])->name('users.update');
    Route::get('/delete/{id}',[UserController::class,'UserDelete'])->name('users.delete');

   
});

//user profile and change password
Route::prefix('profile')->group(function(){
    Route::get('/view',[ProfileController::class,'ProfileView'])->name('profile.view');
    Route::get('/edit',[ProfileController::class,'ProfileEdit'])->name('profile.edit');
    Route::post('/store',[ProfileController::class,'ProfileStore'])->name('profile.store');
    Route::get('/password/view',[ProfileController::class,'PasswordView'])->name('password.view');
    Route::post('/password/update',[ProfileController::class,'PasswordUpdate'])->name('password.update');
});
//setup management
Route::prefix('setups')->group(function(){

    //student class route
    Route::get('/student/class/view',[StudentClassController::class,'ViewStudent'])->name('student.class.view');
    Route::get('/student/class/add',[StudentClassController::class,'AddClassStudent'])->name('student.class.add');
    Route::post('/student/class/store',[StudentClassController::class,'StudentClassStore'])->name('store.student.class');

    Route::get('/student/class/edit/{id}',[StudentClassController::class,'StudentClassEdit'])->name('student.class.edit');

    Route::post('/student/class/update/{id}',[StudentClassController::class,'StudentClassUpdate'])->name('update.student.class');

    Route::get('/student/class/delete/{id}',[StudentClassController::class,'StudentClassDelete'])->name('student.class.delete');

//student year route
Route::get('/student/year/view',[StudentYearController::class,'ViewYear'])->name('student.year.view');
Route::get('/student/year/add',[StudentYearController::class,'AddYear'])->name('student.year.add'); 
Route::post('/student/year/store',[StudentYearController::class,'StudentYearStore'])->name('store.student.year');
Route::get('/student/year/edit/{id}',[StudentYearController::class,'StudentYearEdit'])->name('student.year.edit');

Route::post('/student/year/update/{id}',[StudentYearController::class,'StudentYearUpdate'])->name('update.student.year');
Route::get('/student/year/delete/{id}',[StudentYearController::class,'StudentYearDelete'])->name('student.year.delete');

//student group route
Route::get('/student/group/view',[StudentGroupController::class,'ViewGroup'])->name('student.group.view');
Route::get('/student/group/add',[StudentGroupController::class,'AddGroup'])->name('student.group.add');
Route::post('/student/group/store',[StudentGroupController::class,'StudentGroupStore'])->name('store.student.group');

Route::get('/student/group/edit/{id}',[StudentGroupController::class,'StudentGroupEdit'])->name('student.group.edit');

Route::post('/student/group/update/{id}',[StudentGroupController::class,'StudentGroupUpdate'])->name('update.student.group');
Route::get('/student/group/delete/{id}',[StudentGroupController::class,'StudentGroupDelete'])->name('student.group.delete');

//student shift route
Route::get('/student/shift/view',[StudentShiftController::class,'ViewShift'])->name('student.shift.view');

Route::get('/student/shift/add',[StudentShiftController::class,'AddShift'])->name('student.shift.add');
Route::post('/student/shift/store',[StudentShiftController::class,'StudentShiftStore'])->name('store.student.shift');
Route::get('/student/shift/edit/{id}',[StudentShiftController::class,'StudentShiftEdit'])->name('student.shift.edit');
Route::post('/student/shift/update/{id}',[StudentShiftController::class,'StudentShiftUpdate'])->name('update.student.shift');
Route::get('/student/shift/delete/{id}',[StudentShiftController::class,'StudentShiftDelete'])->name('student.shift.delete');

//student fee route
Route::get('/fee/category/view',[FeeCategoryController::class,'FeeCategoryView'])->name('fee.category.view');
Route::get('/fee/category/add',[FeeCategoryController::class,'FeeCategoryAdd'])->name('student.fee_category.add');
Route::post('/fee/category/store',[FeeCategoryController::class,'StoreFeeCategory'])->name('store.fee.category');
Route::get('/fee/category/edit/{id}',[FeeCategoryController::class,'EditFeeCategory'])->name('fee.category.edit');
Route::post('/fee/category/update/{id}',[FeeCategoryController::class,'UpdateFeeCategory'])->name('update.fee.category');
Route::get('/fee/category/delete/{id}',[FeeCategoryController::class,'FeeCategoryDelete'])->name('fee.category.delete');

//student fee amount route
Route::get('/fee/amount/view',[FeeAmountController::class,'FeeAmountView'])->name('fee.amount.view');
Route::get('/fee/amount/add',[FeeAmountController::class,'AddFeeAmount'])->name('fee.amount.add');
Route::post('/fee/amount/store',[FeeAmountController::class,'StoreFeeAmount'])->name('store.fee.amount');


});