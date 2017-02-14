<?php

 /**
 * Project Name: Smart Music
 * Author Name: Lyheang IBell
 * Date Created: December 2, 2016
 * Version: 1.0
 */


namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Song;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Input;
use DB;
use Validator;


class SongsController extends Controller{

     public function __construct(){
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the authenticate method. We don't want to prevent
       // the user from retrieving their token if they don't already have it
       date_default_timezone_set("Asia/Bangkok");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request) {
        $search = $request->input('search');
        $songs =  DB::table('songs')
         ->leftJoin('tracks', 'tracks.song_id', '=' , 'songs.id')
         ->join('albums', 'albums.id', '=' , 'songs.album_id')
         ->join('artists', 'artists.id', '=', 'songs.artist_id')
         ->select('songs.id','songs.title', 'artists.id as author_id', 'artists.name as author' , 'albums.name as album' , 'songs.url as src','artists.url as thumb','songs.duration', DB::raw('COUNT(tracks.song_id) as views'), 'songs.downloaded')
          ->where('songs.title', 'LIKE', '%' . $search . '%')
          ->orwhere('artists.name', 'LIKE', '%' . $search . '%')
         ->orwhere('albums.name', 'LIKE', '%' . $search . '%')
         ->groupBy('songs.id')
         ->orderBy('songs.id', 'desc')
         ->paginate(25);
         return Response()->json($songs, 200, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('api.songs.create');
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
        
        $requestData = $request->all();
        
        Song::create($requestData);

        Session::flash('flash_message', 'Song added!');

        return redirect('api/songs');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id){
         $songs =  DB::table('songs')
         ->join('albums', 'albums.id', '=' , 'songs.album_id')
         ->join('artists', 'artists.id', '=', 'songs.artist_id')
         ->join('tracks', 'tracks.song_id', '=' , 'songs.id')
         ->select('songs.id','songs.title', 'artists.id as author_id',  'artists.name as author', 'albums.name as album', 'songs.url as src', 'artists.url as thumb','songs.duration',DB::raw('COUNT(tracks.song_id) as views'))
         ->where('songs.id', $id)
         ->orderBy('songs.id', 'desc')
         ->get();
          return Response()->json($songs, 200, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $song = Song::findOrFail($id);

        return view('api.songs.edit', compact('song'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $song = Song::findOrFail($id);
        $song->update($requestData);

        Session::flash('flash_message', 'Song updated!');

        return redirect('api/songs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Song::destroy($id);
        Session::flash('flash_message', 'Song deleted!');
        return redirect('api/songs');
    }

    /**
     * search the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
     public function search(Request $request){
        $query =  $request->input('search');
        $songs =  DB::table('songs')
         ->leftJoin('tracks', 'tracks.song_id', '=' , 'songs.id') 
         ->join('albums', 'albums.id', '=' , 'songs.album_id')
         ->join('artists', 'artists.id', '=', 'songs.artist_id')
         ->select('artists.id','songs.title', 'artists.name as author', 'albums.name as album', 'songs.url as src', 'artists.url as thumb','songs.duration',DB::raw('COUNT(tracks.song_id) as views'))
        ->where('songs.title', 'LIKE', '%' . $query . '%')
        ->orwhere('artists.name', 'LIKE', '%' . $query . '%')
        ->orwhere('albums.name', 'LIKE', '%' . $query . '%')
        ->groupBy('songs.id')
        ->paginate(25);
         return Response()->json($songs, 200, [], JSON_NUMERIC_CHECK);
     }

     /**
     * new song for web a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
     public function newSong() {
        $songs =  DB::table('songs')
         ->join('artists', 'artists.id', '=', 'songs.artist_id')
         ->select('songs.id','songs.title', 'artists.url as thumb', 'artists.name as author', 'songs.url as src','songs.duration')
         ->orderBy('songs.id', 'desc')
         ->paginate(8);
          return Response()->json($songs, 200, [], JSON_NUMERIC_CHECK);
    }

}
