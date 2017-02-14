<?php

 /**
 * Project Name: Smart Music
 * Author Name: Lyheang IBell
 * Date Created: December 2, 2016
 * Version: 1.0
 */
 
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Session;
use Auth;
use Illuminate\Support\Facades\Input;
use DB;
use Validator;
use Helper;
use Hash;

class UserController extends Controller{

    public function __construct(){
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the authenticate method. We don't want to prevent
       // the user from retrieving their token if they don't already have it
       date_default_timezone_set("Asia/Bangkok");
    }

    public function index(){
       return view('auth.profile');
    }

    public function users(){
      $users = User::paginate(15);
      return view('auth.index', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

   public function update(Request $request, $id){

         $validator = Validator::make( $request->all(), [
            'name' => 'required|min:6',
         ]);
         if( $validator->fails() ){
           return redirect()->back()->withErrors($validator);
         }else{
          $requestData = $request->all();
          $user = User::findOrFail($id);
          $user->update($requestData);
          Session::flash('flash_message', 'Your personal information have been updated!');
          Session::flash('flash_class', 'alert-success');
          return redirect('/admin/profile');

         }
   }

   public function changePassword($id){
        $rules = array(
                    'oldPassword'       =>  'required|string|min:6',
                    'newPassword'       =>  'required|string|min:6',
                    'confirmPassword'       =>  'required|same:newPassword'
                    );

        $validator = Validator::make(Input::only('oldPassword', 'newPassword', 'confirmPassword'), $rules);

        if($validator->fails()){
            Session::flash('flash_message', 'New password and Confirm password did not match.');
            Session::flash('flash_class', 'alert-danger');
           return redirect('/admin/profile');
        }else{
          $users = User::where('id', '=', $id)->first();
          if (Hash::check(Input::get('oldPassword'), $users->password)){
             if(Input::get('newPassword') == Input::get('confirmPassword')){
                       $users->password =Hash::make(Input::get('newPassword'));
                       $users->save();
                       Session::flash('flash_message', 'Password changed Successfully.');
                       Session::flash('flash_class', 'alert-success');
                       return redirect('/admin/profile');
              } else{
                        Session::flash('flash_message', 'New password and Confirm password did not match.');
                        Session::flash('flash_class', 'alert-danger');
                        return redirect('/admin/profile');
                    }

                }else{
                  Session::flash('flash_message', 'Current password is incorrect.');
                  Session::flash('flash_class', 'alert-danger');
                  return redirect('/admin/profile');
            }
        }
    }



}
