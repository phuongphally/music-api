<?php

 /**
 * Project Name: Smart Music
 * Author Name: Lyheang IBell
 * Date Created: December 2, 2016
 * Version: 1.0
 */

namespace App\Http\Controllers\Api;

use App\Album;
use App\Artist;
use App\Track;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Song;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use DB;
use Response;

class BestController extends Controller{

     public function __construct(){
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the authenticate method. We don't want to prevent
       // the user from retrieving their token if they don't already have it
       date_default_timezone_set("Asia/Bangkok");
    }
    public function index(){
        $top = DB::table('songs')
        ->select(array('songs.id', 'songs.title', 'artists.url as thumb', 'artists.name as author', 'songs.url as src','songs.duration'))
         ->join('artists', 'artists.id', '=', 'songs.artist_id')
         ->leftJoin('tracks', 'tracks.song_id', '=' , 'songs.id')
         ->groupBy('tracks.song_id')
         ->take(5)
         ->get();
         return Response()->json(['data' => $top], 200, [], JSON_NUMERIC_CHECK);
 
    }


}
