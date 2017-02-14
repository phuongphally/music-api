<?php

 /**
 * Project Name: Smart Music
 * Author Name: Lyheang IBell
 * Date Created: December 2, 2016
 * Version: 1.0
 */


namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Song;
use App\Album;
use App\Artist;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Input;
use DB;
use Validator;
use Auth;

class SongsController extends Controller
{
     public function __construct()  {
      $this->middleware('auth');
       date_default_timezone_set("Asia/Bangkok");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $songs =  DB::table('songs')
         ->leftJoin('tracks', 'tracks.song_id', '=' , 'songs.id')
         ->join('albums', 'albums.id', '=' , 'songs.album_id')
         ->join('artists', 'artists.id', '=', 'songs.artist_id')
         ->select('songs.id', 'songs.title', 'albums.name as album', 'songs.content', 'artists.name as artist', 'songs.url as mp3','artists.url as poster','songs.duration', DB::raw('COUNT(tracks.song_id) as views'))
         ->groupBy('songs.id')
         ->orderBy('songs.id', 'desc')
         ->paginate(15);
         return view('admin.songs.index', compact('songs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(){
         $albums = Album::all();
         $artists = Artist::all();
        return view('admin.songs.create', compact('albums','artists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {
        
        $this->validate($request, [
            'title' => 'required', 
            'url' => 'required_with:title',
            'duration' => 'required', 
            'album_id' => 'required',
            'artist_id' => 'required', 
            ]);
        Song::create($request->all());
        Session::flash('flash_message', 'Song added!');
        Session::flash('flash_class', 'alert-success');
        return redirect('admin/songs');
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
         ->select('songs.id','songs.title', 'artists.name as artist', 'albums.name as album', 'songs.url as mp3', 'artists.url as poster',DB::raw('COUNT(tracks.song_id) as views'))
         ->where('songs.id', $id)
         ->orderBy('songs.id', 'desc')
         ->get();
        return Response()->json($songs);
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

        $albums = Album::all();
        $artists = Artist::all();

        return view('admin.songs.edit', compact('song','albums','artists'));

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
        Session::flash('flash_class', 'alert-success');
        return redirect('admin/songs');
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
        Session::flash('flash_class', 'alert-success');
        return redirect('admin/songs');
    }
}
