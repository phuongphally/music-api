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

use App\Artist;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Response;
use DB;
use Auth;
use Validator;
use Illuminate\Support\Facades\File;
use Image;

class ArtistsController extends Controller {

     public function __construct()  {
      $this->middleware('auth');
       date_default_timezone_set("Asia/Bangkok");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(){
        $artists =  DB::table('artists')
        ->select('artists.id','artists.name', 'artists.bio','artists.url')
        ->orderBy('id', 'desc')
        ->paginate(15);
        return view('admin.artists.index', compact('artists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(){
        return view('admin.artists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {
         $file = $request->url;
         $name = $request->name;
         $bio = $request->bio;
         $validator = Validator::make($request->all(), [
            'name' =>'required|unique:artists|max:255', 
            'url' => 'required_with:name|image', 
            ]);
            if($validator->fails()){ 
                Session::flash('flash_message', 'Something went wrong!');
                Session::flash('flash_class', 'alert-danger');
            }else{
                $extension = $file->getClientOriginalExtension(); 
                $filename = rand(11111,99999).'.'.$extension; // renameing image
                $tmp_path = public_path('artists/thumbnail/');
                $letmovefiles   = $file->move($tmp_path, $filename);
                $full = $tmp_path.$filename;
                $destinationPath = public_path('artists/');
                if ($_FILES['url']) {
                    $image   = Image::make($full);
                    $image->resize(300, 300)->save();
                    $new_path = $destinationPath;
                    rename($destinationPath,$new_path);  
                }
                $getlnik = url('artists/thumbnail').'/'.$filename;
                $data =  array(
                    'name' => $name,
                    'bio' => $bio,
                    'url'   => $getlnik,
                );
            $save = DB::table('artists')->insert($data);
            Session::flash('flash_message', 'Artist added!');
            Session::flash('flash_class', 'alert-success');
        }
        return redirect('admin/artists');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id){
        $artist = Artist::findOrFail($id);
        return view('admin.artists.show', compact('artist'));
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

        return view('admin.artists.edit', compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request) {
         $file = $request->url;
         $name = $request->name;
         $bio = $request->bio;
        if(empty($file)){
             $validator = Validator::make($request->all(), ['name' => 'required']);
            
            if($validator->fails()){ 

                Session::flash('flash_message', 'Something went wrong!');
                Session::flash('flash_class', 'alert-danger');
            }else{
                $data =  array(
                    'name' => $name,
                    'bio' => $bio,
                );
                $save = DB::table('artists')->where('id',$id)->update($data);
                Session::flash('flash_message', 'Artist updated!');
                Session::flash('flash_class', 'alert-success');
            }
         }else{
            $validator = Validator::make($request->all(), ['name' => 'required', 'url' => 'required', ]);
            if($validator->fails()){ 
                Session::flash('flash_message', 'Something went wrong!');
                Session::flash('flash_class', 'alert-danger');
            }else{
                $extension = $file->getClientOriginalExtension(); 
                $filename = rand(11111,99999).'.'.$extension; // renameing image
                $tmp_path = public_path('artists/thumbnail/');
                $letmovefiles   = $file->move($tmp_path, $filename);
                $full = $tmp_path.$filename;
                $destinationPath = public_path('artists/');
                if ($_FILES['url']) {
                    $image   = Image::make($full);
                    $image->resize(300, 300)->save();
                    $new_path = $destinationPath;
                    rename($destinationPath,$new_path);  
                }
                $getlnik = url('artists/thumbnail').'/'.$filename;
                $data =  array(
                    'name' => $name,
                    'bio' => $bio,
                    'url'   => $getlnik,
                );
                $save = DB::table('artists')->where('id',$id)->update($data);
                Session::flash('flash_message', 'Artist updated!');
                Session::flash('flash_class', 'alert-success');
            }
        }
        return redirect('admin/artists');
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
        Session::flash('flash_class', 'alert-success');
        return redirect('admin/artists');
    }
}
