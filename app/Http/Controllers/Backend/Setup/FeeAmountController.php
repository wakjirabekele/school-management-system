<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\FeeCategoryAmount;

class FeeAmountController extends Controller
{
    public function FeeAmountView()
    {
        // $data['allData'] = FeeCategoryAmount::all();
        $data['allData'] = FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.setup.fee_amount.view_fee_amount', $data);
    }
    public function AddFeeAmount()
    {
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.add_fee_amount', $data);
    }
    public function StoreFeeAmount(Request $request)
    {
        $countClass = count($request->class_id);
        if ($countClass != NULL) {
            for ($i = 0; $i < $countClass; $i++) {
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            }
        }
        $notification = array(
            'message' => 'Fee Amount Added Successfully',
            'alert-type' => 'success',
        );
        return Redirect()->route('fee.amount.view')->with($notification);
    }
    public function FeeAmountEdit($fee_category_id)
    {

        $data['editData'] = FeeCategoryAmount::where('fee_category_id', $fee_category_id)->orderBy('class_id', 'asc')->get();

        //dd($data['editData']->toArray());

        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.edit_fee_amount', $data);
    }
    public function UpdateFeeAmount(Request $request, $fee_category_id)
    {
        if ($request->class_id == NULL) {
            $notification = array(
                'message' => 'Oops !, you didnt select any class amount.',
                'alert-type' => 'error',
            );
            return Redirect()->route('fee.amount.edit', $fee_category_id)->with($notification);
        } else {
            $countClass = count($request->class_id);
            //delete all previous data with specified id
            FeeCategoryAmount::where('fee_category_id', $fee_category_id)->delete();
            //insert new data
            
                for ($i = 0; $i < $countClass; $i++) {
                    $fee_amount = new FeeCategoryAmount();
                    $fee_amount->fee_category_id = $request->fee_category_id;
                    $fee_amount->class_id = $request->class_id[$i];
                    $fee_amount->amount = $request->amount[$i];
                    $fee_amount->save();
                }
        }
        $notification = array(
            'message' => 'Data Updated Successfully !',
            'alert-type' => 'success',
        );
        return Redirect()->route('fee.amount.view',$fee_category_id)->with($notification);
    } //end method
    public function FeeAmountDetails($fee_category_id){
        $data['detailsData'] = FeeCategoryAmount::where('fee_category_id', $fee_category_id)->orderBy('class_id', 'asc')->get();

        return view('backend.setup.fee_amount.details_fee_amount',$data);
    }
}
