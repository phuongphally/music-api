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


class GeneralCommentsController extends Controller{
    public function __construct(){
       date_default_timezone_set("Asia/Bangkok");
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index($id){
        $comments =  DB::table('comments')
         ->select('comments.id','comments.content', 'comments.user_id' , 'users.name', 'users.profile as thumb','comments.created_at') 
         ->Join('artists', 'artists.id', '=', 'comments.artist_id')
         ->Join('users', 'users.id', '=', 'comments.user_id')
         ->where('comments.artist_id', $id)
         ->orderBy('comments.id', 'desc')
         ->paginate(10);
         return Response()->json($comments, 200, [], JSON_NUMERIC_CHECK);
   
    }

}
