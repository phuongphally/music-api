<?php

namespace App\Http\Controllers\Admin;

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
        $this->middleware('auth');
    }

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(){
        $comments =  DB::table('comments')
         ->select('comments.id','comments.content', 'comments.user_id' ,'artists.name as author', 'users.name', 'users.profile as thumb','comments.created_at') 
         ->Join('artists', 'artists.id', '=', 'comments.artist_id')
         ->Join('users', 'users.id', '=', 'comments.user_id')
         ->orderBy('comments.id', 'desc')
         ->paginate(10);
          return view('admin.comments.index', compact('comments'));
    }
}
