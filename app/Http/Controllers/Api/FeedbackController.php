<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Feedback;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Input;
use DB;
use Validator;
use Carbon\Carbon;


class FeedbackController extends Controller
{

        public function __construct(){
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the authenticate method. We don't want to prevent
       // the user from retrieving their token if they don't already have it
      // $this->middleware('jwt.auth', ['except' => ['authenticate']]);
       date_default_timezone_set("Asia/Bangkok");
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
           $content = $request->input('content');
           if(empty($title)){
                return Response()->json(['error' => "Title is required" ], 406);
           }else if(empty($content)){
                return Response()->json(['error' => "Content is required" ], 406);
           }
           $data = Feedback::create(
            [
                'title' => $title,
                'content' => $content,
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
            );
         return Response()->json(['data' => 'Thank you for your feedback!']);
    }

   
}
