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

class TopController extends Controller{

     public function __construct(){
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the authenticate method. We don't want to prevent
       // the user from retrieving their token if they don't already have it
       date_default_timezone_set("Asia/Bangkok");
    }

    public function index(){
        $top = DB::table('songs')
        ->select(array('songs.id', 'artists.id as author_id', 'artists.name as author',  'songs.title', 'albums.name as album', 'songs.url as src','artists.url as thumb', 'songs.duration',  DB::raw('COUNT(tracks.song_id) as views'), 'songs.downloaded'))
         ->leftJoin('tracks', 'tracks.song_id', '=' , 'songs.id')
         ->join('artists', 'artists.id', '=', 'songs.artist_id')
         ->join('albums', 'albums.id', '=' , 'songs.album_id')
         ->groupBy('tracks.song_id')
         ->orderBy('views','desc')
         ->paginate(25);
         return Response()->json($top, 200, [], JSON_NUMERIC_CHECK);
    }
    
    public function topTen(){
        $top = DB::table('songs')
        ->select(array('songs.id','artists.name as author', 'songs.title', 'albums.name as album', 'songs.url as src','artists.url as thumb','songs.duration', DB::raw('COUNT(tracks.song_id) as views'), 'songs.downloaded'))
         ->join('artists', 'artists.id', '=', 'songs.artist_id')
         ->join('albums', 'albums.id', '=' , 'songs.album_id')
         ->leftJoin('tracks', 'tracks.song_id', '=' , 'songs.id')
         ->groupBy('tracks.song_id')
         ->orderBy('views','desc')
         ->paginate(25);
         return Response()->json($top, 200, [], JSON_NUMERIC_CHECK);
    }


}
