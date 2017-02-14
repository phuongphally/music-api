<?php

namespace App\Http\Controllers\Api;



use App\Track;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use DB;
use Response;


class TrackController extends Controller{

	 public function __construct(){
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the authenticate method. We don't want to prevent
       // the user from retrieving their token if they don't already have it
       date_default_timezone_set("Asia/Bangkok");
    }

    public function track(Request $request){
       $id =  $request->input('song_id');
       $data =  array(
       	'song_id' => $id,
       	);
       $save = DB::table('tracks')->insert($data);
       return Response()->json(['status_code' => 200, 'message' => 'Success', 'data' => $save ]);
    }

      public function trackArtist(Request $request){
       $id =  $request->input('artist_id');
       $data =  array(
       	'artist_id' => $id,
       	);
       $save = DB::table('tracks')->insert($data);
       return Response()->json(['status_code' => 200, 'message' => 'Success', 'data' => $save ]);
    }

     public function download(Request $request){
       $id =  $request->input('song_id');
       $data =  array(
        'song_id' => $id,
        );
      $update =  DB::table('songs')->whereId($id)->increment('downloaded'); 
       return Response()->json(['status_code' => 200, 'message' => 'Success', 'data' => $update ]);
    }


}
