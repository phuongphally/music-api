<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Comment;
use Illuminate\Http\Request;
use Session;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Input;
use DB;
use Validator;
use Auth;
use Carbon\Carbon;


class CommentsController extends Controller{
    public function __construct(){
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the authenticate method. We don't want to prevent
       // the user from retrieving their token if they don't already have it
       date_default_timezone_set("Asia/Bangkok");
         $this->middleware('jwt.auth', ['except' => ['authenticate']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request){

        $this->middleware('jwt.auth', ['except' => ['authenticate']]);
        
        $validation = Validator::make(Input::all(),[
            'user_id' => 'required',
            'artist_id' => 'required',
            'content' => 'required',
             ]);
          if($validation->fails()){
            return Response()->json($validation->messages());
          }else{
           $comments = Comment::create([
            'user_id' => $request->input('user_id'),
            'artist_id' => $request->input('artist_id'),
            'content' => $request->input('content'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
          ]);
          return Response()->json(['status_code' => 200, 'message' => 'Success', 'data' => $comments]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id){
        Comment::destroy($id);
        return Response()->json(['status_code' => 200, 'message' => 'Success']);
    }
}
