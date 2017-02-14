<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use Illuminate\Support\Facades\Input;
use DB;
use Validator;
use Carbon\Carbon;
use Helper;
use Hash;

class AuthController extends Controller{

     public function __construct(){
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the authenticate method. We don't want to prevent
       // the user from retrieving their token if they don't already have it
       date_default_timezone_set("Asia/Bangkok");
    }

    public function login(Request $request){
        $credentials = Input::only('email', 'password');
        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid Credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
               return response()->json(['error' => 'Could not create token'], 500);
        }
        $user = JWTAuth::toUser($token);

        $data =  array( 'last_login' => Carbon::now(), );
        $last_login = DB::table('users')->where('id',$user->id)->update($data);
        return response()->json(['id' => $user->id, 'name' => $user->name, 'profile' => $user->profile, 'email' =>$user->email,'token' => $token, 'last_login' =>$user->last_login ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function register(Request $request){

          $validation = Validator::make(Input::all(),[
            'name' => 'required|min:6',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6', ]);
          if($validation->fails()){

             return Response()->json(['status_code' => 400, 'data' =>  $validation->messages()]);

          }else{

           $users = User::create([
            'name' =>  $request->input('name'),
            'email' =>  $request->input('email'),
            'password' => bcrypt($request->input('password')),

          ]);
          return Response()->json($users);
        }
    }


     /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function updateProfile(Request $request){

          $validation = Validator::make(Input::all(),[
            'id' => 'required',
            'name' => 'required|min:6',
            ]);
         if( $validation->fails()){
            return Response()->json(['status_code' => 400, 'data' =>  $validation->messages()]);
         }else{
           $data =  array(
              'name' => $request->input('name'),
              'updated_at' => Carbon::now(),
            );
          $users = DB::table('users')->where('id', $request->input('id'))->update($data);
          if($users == 1){
            return Response()->json(['status_code' => 200, 'message' => 'Success']);
          }else{
              return Response()->json(['status_code' => 400, 'message' => 'Bad Request']);
          }
      }
   }
   // update password api
   public function changePassword(Request $request){
        $rules = array(
                    'oldPassword'       =>  'required|string|min:6',
                    'newPassword'       =>  'required|string|min:6',
                    'confirmPassword'       =>  'required|same:newPassword'
           );
        $validator = Validator::make(Input::only('oldPassword', 'newPassword', 'confirmPassword'), $rules);

        if($validator->fails()){
          return Response()->json(['status_code' => 400, 'message' =>  $validator->messages()]);
        }else{
           $users = User::where('id', '=', $request->input('id'))->first();
          if (Hash::check(Input::get('oldPassword'), $users->password)){
             if(Input::get('newPassword') == Input::get('confirmPassword')){
                       $users->password =Hash::make(Input::get('newPassword'));
                       $users->save();
                       return Response()->json(['status_code' => 200, 'message' => 'Password changed Successfully.']);
              } else{
                      return Response()->json(['status_code' => 400, 'message' => 'New password and Confirm password did not match.']);
                    }

                }else{
                  return Response()->json(['status_code' => 400, 'message' => 'Current password is incorrect.']);
            }
        }
    }
}
