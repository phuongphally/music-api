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

use App\Album;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Input;
use DB;
use Validator;

class AlbumsController extends Controller
{
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
    public function index() {
         $albums =  DB::table('albums')
         ->select('albums.id','albums.name' ,'albums.url',DB::raw('COUNT(songs.album_id) as total_songs')) 
         ->leftJoin('songs', 'songs.album_id', '=', 'albums.id')
         ->groupBy('albums.id')
         ->orderBy('albums.id', 'desc')
         ->paginate(26);
          return Response()->json($albums, 200, [], JSON_NUMERIC_CHECK);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('api.albums.create');
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
        
        Album::create($requestData);

        Session::flash('flash_message', 'Album added!');

        return redirect('api/albums');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
     $albums =  DB::table('songs')
        ->join('albums', 'albums.id', '=' , 'songs.album_id')
        ->join('artists', 'artists.id', '=' , 'songs.artist_id')
        ->leftJoin('tracks', 'tracks.song_id', '=' , 'songs.id')
        ->where('songs.album_id', $id)
        ->select('albums.id as id', 'songs.id as sid', 'songs.title', 'albums.name as album', 'songs.url as src','artists.name as author','artists.url as thumb','songs.duration', DB::raw('COUNT(tracks.song_id) as views'), 'songs.downloaded')
        ->groupBy('songs.id')
        ->paginate(25);       
       return Response()->json($albums, 200, [], JSON_NUMERIC_CHECK);
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
        $album = Album::findOrFail($id);

        return view('api.albums.edit', compact('album'));
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
        
        $album = Album::findOrFail($id);
        $album->update($requestData);

        Session::flash('flash_message', 'Album updated!');

        return redirect('api/albums');
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
        Album::destroy($id);

        Session::flash('flash_message', 'Album deleted!');

        return redirect('api/albums');
    }
}
