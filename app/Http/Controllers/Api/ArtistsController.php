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

use App\Artist;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Response;
use DB;

class ArtistsController extends Controller {
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
    public function index(){
        $artists =  DB::table('artists')
         ->select('artists.id','artists.name as author','artists.url as thumb','artists.bio',DB::raw('COUNT(songs.artist_id) as total_songs')) 
         ->leftJoin('songs', 'songs.artist_id', '=', 'artists.id')
         ->groupBy('artists.id')
         ->orderBy('artists.id', 'desc')
         ->paginate(26);
          return Response()->json($artists, 200, [], JSON_NUMERIC_CHECK);
   
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('api.artists.create');
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
        
        Artist::create($requestData);

        Session::flash('flash_message', 'Artist added!');

        return redirect('api/artists');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id){

        $artist =  DB::table('songs')
         ->select('songs.id','songs.title', 'artists.name as author', 'albums.name as album', 'songs.url as src', 'artists.url as thumb','songs.duration',DB::raw('COUNT(tracks.song_id) as views'), 'songs.downloaded')
         ->leftJoin('tracks', 'tracks.song_id', '=' , 'songs.id')
         ->join('albums', 'albums.id', '=' , 'songs.album_id')
         ->join('artists', 'artists.id', '=', 'songs.artist_id')
         ->where('songs.artist_id', $id)
           ->groupBy('songs.id')
         ->paginate(25);
          return Response()->json($artists, 200, [], JSON_NUMERIC_CHECK);
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
        $artist = Artist::findOrFail($id);

        return view('api.artists.edit', compact('artist'));
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
        
        $artist = Artist::findOrFail($id);
        $artist->update($requestData);

        Session::flash('flash_message', 'Artist updated!');

        return redirect('api/artists');
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
        Artist::destroy($id);

        Session::flash('flash_message', 'Artist deleted!');

        return redirect('api/artists');
    }

    public function recently(){
        $artists =  DB::table('artists')
         ->leftJoin('songs', 'songs.artist_id', '=', 'artists.id')
         ->select('artists.id','artists.name as author', 'artists.bio','artists.url as thumb', DB::raw('COUNT(songs.artist_id) as total_songs'))
         ->groupBy('artists.id')
         ->orderBy('id', 'desc')
         ->paginate(5);
        return Response()->json($artists, 200, [], JSON_NUMERIC_CHECK);
    }

    public function trending(){
        $artists =  DB::table('artists')
         ->select('artists.id','artists.name as author', 'artists.bio', 'songs.title','artists.url as thumb', 'songs.url as src')
        ->leftJoin('tracks', 'tracks.artist_id', '=' , 'artists.id')
        ->join('songs', 'songs.artist_id', '=', 'artists.id')
        ->groupBy('artists.id')
        ->orderBy('artists.id', 'desc')
        ->paginate(8);
        return Response()->json($artists, 200, [], JSON_NUMERIC_CHECK);
    }

    public function mayLike(Request $request){
        $artists =  DB::table('artists')
        ->select('artists.id','artists.name as author', 'artists.bio','artists.url as thumb','songs.title','songs.url as src')
        ->join('songs', 'songs.artist_id', '=', 'artists.id')
        ->inRandomOrder()->limit(4)->get();
        return Response()->json(['data' => $artists], 200, [], JSON_NUMERIC_CHECK);

    }


}
