<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function UserView(){
        //$allData=User::all();
        $data['allData']=User::all();
        return view('backend.user.view_user',$data);
    }
    public function UserAdd()
    {
        return view('backend.user.add_user');
    }
    public function UserStore(Request $request){

        $validation=$request->validate([
         'email'=>'required|unique:users',
         'name'=>'required',
        ]);

        $data=new User();
        $data->usertype=$request->usertype;
        $data->name=$request->name;
        $data->email=$request->email;
        $data->password=bcrypt($request->password);
        $data->save();

        $notification=array(
        'message'=>'User Added Successfully',
        'alert-type'=>'success',
        );
        return Redirect()->route('user.view')->with($notification);
    }
    public function UserEdit($id){
        $editData=User::find($id);
        return view('backend.user.edit_user',compact('editData'));
    }
    public function UserUpdate(Request $request, $id){
        // $validation=$request->validate([
        //     'email'=>'required|unique:users',
        //     'name'=>'required',
        //    ]);
           $data=User::find($id);
           $data->usertype=$request->usertype;
           $data->name=$request->name;
           $data->email=$request->email;
          // $data->password=bcrypt($request->password);
           $data->save();
   
           $notification=array(
           'message'=>'User Updated Successfully !',
           'alert-type'=>'success',
           );
           return Redirect()->route('user.view')->with($notification);
    }
    public function UserDelete(Request $request, $id){
        $data=User::findOrFail($id);
        $data->delete();

        $notification=array(
            'message'=>'User Delete Successfully !',
            'alert-type'=>'info',
            );
            return Redirect()->route('user.view')->with($notification);
    }
}
