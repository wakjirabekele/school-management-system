<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategory;
class FeeCategoryController extends Controller
{
    public function FeeCategoryView(){
        $data['allData']=FeeCategory::all();
        return view('backend.setup.fee_category.view_fee_category',$data);
    }
    public function FeeCategoryAdd(){
        return view('backend.setup.fee_category.add_fee_category');
    }
    public function StoreFeeCategory(Request $request){
        $validation=$request->validate([
            'name'=>'required|unique:fee_categories,name',
           ]);

        $data= new FeeCategory();
        $data->name=$request->name;
        $data->save();

        $notification=array(
            'message'=>'Fee Category Added Successfully',
            'alert-type'=>'success',
            );
            return Redirect()->route('fee.category.view')->with($notification);
    }
    public function EditFeeCategory($id){
        $editData=FeeCategory::find($id);
        return view('backend.setup.fee_category.edit_fee_category',compact('editData'));
    }
    public function UpdateFeeCategory(Request $request,$id){
        $validation=$request->validate([
            'name'=>'required|unique:fee_categories,name',
           ]);

           $data=FeeCategory::find($id);
           $data->name=$request->name;
           $data->save();
   
           $notification=array(
           'message'=>'Category Updated Successfully !',
           'alert-type'=>'success',
           );
           return Redirect()->route('fee.category.view')->with($notification);
    }
    public function FeeCategoryDelete(Request $request,$id){
        $data=FeeCategory::findOrFail($id);
    $data->delete();

    $notification=array(
        'message'=>'Category Deleted Successfully !',
        'alert-type'=>'info',
        );
        return Redirect()->route('fee.category.view')->with($notification);
    }
}
