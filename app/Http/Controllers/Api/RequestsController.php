<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Requestsong;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Input;
use DB;
use Validator;
use Carbon\Carbon;


class RequestsController extends Controller
{
    
   public function __construct(){
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the authenticate method. We don't want to prevent
       // the user from retrieving their token if they don't already have it
      // $this->middleware('jwt.auth', ['except' => ['authenticate']]);
       date_default_timezone_set("Asia/Bangkok");
    }

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $requests =  DB::table('requests')
        ->select('requests.id','requests.title', 'requests.artist as author', 'requests.src','requests.thumb','requests.duration')
          ->where('requests.title', 'LIKE', '%' . $search . '%')
          ->orwhere('requests.artist', 'LIKE', '%' . $search . '%')
         ->orderBy('id', 'desc')
         ->paginate(25);
         return Response()->json($requests, 200, [], JSON_NUMERIC_CHECK);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

           $title = $request->input('title');
           $artist = $request->input('artist');
           $content = $request->input('content');
           if(empty($title)){
                return Response()->json(['error' => "Title is required" ], 406);
           }else if(empty($content)){
                return Response()->json(['error' => "Content is required" ], 406);
           }
           else if(empty($artist)){
                return Response()->json(['error' => "Artist is required" ], 406);
           }else{

            $data = Requestsong::create([
                'title' => $title,
                'artist' => $artist,
                'content' => $content,
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
                ]);
           }
           

         return Response()->json(['data' => 'Your requests have been sent.']);

    }

    
}
