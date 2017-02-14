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

use App\Album;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Input;
use DB;
use Validator;
use Illuminate\Support\Facades\File;
use Image;
use Auth;

class AlbumsController extends Controller
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
         $albums =  DB::table('albums')
         ->select('albums.id', 'albums.name', 'albums.content','albums.url')
         ->orderBy('id', 'desc')
         ->paginate(25);
          return view('admin.albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.albums.create');
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
        
         $file = $request->url;
         $name = $request->name;
         $content = $request->content;
         
         $validator = Validator::make($request->all(), ['name' => 'required|unique:albums|max:255', 'url' => 'required', ]);
            if($validator->fails()){ 
                Session::flash('flash_message', 'Something went wrong!');
                Session::flash('flash_class', 'alert-danger');
            }else{
                $extension = $file->getClientOriginalExtension(); 
                $filename = rand(11111,99999).'.'.$extension; // renameing image
                $tmp_path = public_path('albums/thumbnail/');
                $letmovefiles   = $file->move($tmp_path, $filename);
                $full = $tmp_path.$filename;
                $destinationPath = public_path('albums/');
                if ($_FILES['url']) {
                    $image   = Image::make($full);
                    $image->resize(300, 300)->save();
                    $new_path = $destinationPath;
                    rename($destinationPath,$new_path);  
                }
                $getlnik = url('albums/thumbnail').'/'.$filename;
                $data =  array(
                    'name' => $name,
                    'url'   => $getlnik,
                    'content' => $content
                );
                $save = DB::table('albums')->insert($data);
                Session::flash('flash_message', 'Album added!');
                Session::flash('flash_class', 'alert-success');
            }
        return redirect('admin/albums');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $album = Album::findOrFail($id);
        return view('admin.albums.show', compact('album'));
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

        return view('admin.albums.edit', compact('album'));
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
        
         $file = $request->url;
         $name = $request->name;
         $content = $request->content;

         if(empty($file)){
            $validator = Validator::make($request->all(), ['name' => 'required|unique:albums|max:255']);
            if($validator->fails()){ 
                Session::flash('flash_message', 'Something went wrong!');
                Session::flash('flash_class', 'alert-danger');
            }else{
                $data =  array(
                    'name' => $name,
                    'content' => $content
                );  
                 $save = DB::table('albums')->where('id',$id)->update($data);
                Session::flash('flash_message', 'Album updated!');
                 Session::flash('flash_class', 'alert-success');
            }
         }else{

            $validator = Validator::make($request->all(), 
                ['name' => 'required|max:255', 'url' => 'required']);
            if($validator->fails()){ 
                dd($validator);
                Session::flash('flash_message', 'Something went wrong!');
                Session::flash('flash_class', 'alert-danger');
            }else{
                $extension = $file->getClientOriginalExtension(); 
                $filename = rand(11111,99999).'.'.$extension; // renameing image
                $tmp_path = public_path('albums/thumbnail/');
                $letmovefiles   = $file->move($tmp_path, $filename);
                $full = $tmp_path.$filename;
                $destinationPath = public_path('albums/');
                if ($_FILES['url']) {
                    $image   = Image::make($full);
                    $image->resize(300, 300)->save();
                    $new_path = $destinationPath;
                    rename($destinationPath,$new_path);  
                }
                $getlnik = url('albums/thumbnail').'/'.$filename;
                $data =  array(
                    'name' => $name,
                    'url'   => $getlnik,
                    'content' => $content
                );
                
                 $save = DB::table('albums')->where('id',$id)->update($data);
                 Session::flash('flash_message', 'Album updated!');
                 Session::flash('flash_class', 'alert-success');
            }
        }
       
        return redirect('admin/albums');
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
        Session::flash('flash_class', 'alert-success');
        return redirect('admin/albums');
    }
}
