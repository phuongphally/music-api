<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Requestsong;

use Session;
use Illuminate\Support\Facades\Input;
use DB;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Image;
use Auth;
use Carbon\Carbon;

class RequestsController extends Controller
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
    public function index()
    {
        $requests = Requestsong::orderBy('id', 'desc')->paginate(25);

        return view('admin.requests.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.requests.create');
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
        Requestsong::create($requestData);
        Session::flash('flash_message', 'Request added!');
        return redirect('admin/requests');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $request = Requestsong::findOrFail($id);
        
        return view('admin.requests.show', compact('request'));
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
        $request = Requestsong::findOrFail($id);

        return view('admin.requests.edit', compact('request'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request){

         $title = $request->title;
         $artist = $request->artist;
         $duration = $request->duration;
         $src = $request->src;
         $thumb = $request->thumb;
         $content = $request->content;

           if(empty($thumb)){
                $validator = Validator::make($request->all(), [
                'title' =>'required', 
                'src' => 'required',
                'artist' => 'required',
                'duration' => 'required',  
                ]);
                if($validator->fails()){ 
                    Session::flash('flash_message', 'Something went wrong!');
                    Session::flash('flash_class', 'alert-danger');
                   }else{
                    $data =  array(
                    'title' => $title,
                    'artist' => $artist,
                    'src' => $src,
                    'content' => $content,
                    'duration' => $duration,
                    'status' => 1,
                    );
                    $update = DB::table('requests')->where('id',$id)->update($data);
                    Session::flash('flash_message', 'Request updated!');
                    Session::flash('flash_class', 'alert-success');
                }

           }else{
            $validator = Validator::make($request->all(), [
                'title' =>'required', 
                'thumb' => 'required_with:title|image', 
                'src' => 'required',
                'artist' => 'required',
                'duration' => 'required',  
                ]);
                if($validator->fails()){ 
                    Session::flash('flash_message', 'Something went wrong!');
                    Session::flash('flash_class', 'alert-danger');
                }else{
                    $extension = $thumb->getClientOriginalExtension(); 
                    $filename = rand(11111,99999).'.'.$extension; // renameing image
                    $tmp_path = public_path('artists/thumbnail/');
                    $letmovefiles   = $thumb->move($tmp_path, $filename);
                    $full = $tmp_path.$filename;
                    $destinationPath = public_path('artists/');
                    if ($_FILES['thumb']) {
                        $image   = Image::make($full);
                        $image->resize(200, 200)->save();
                        $new_path = $destinationPath;
                        rename($destinationPath,$new_path);  
                    }
                    $getlnik = url('artists/thumbnail').'/'.$filename;
                    $data =  array(
                        'title' => $title,
                        'artist' => $artist,
                        'src' => $src,
                        'content' => $content,
                        'thumb'   => $getlnik,
                        'duration' => $duration,
                        'status' => 1,
                    );
                   
                    $update = DB::table('requests')->where('id',$id)->update($data);
                    Session::flash('flash_message', 'Request updated!');
                    Session::flash('flash_class', 'alert-success');
                }
           }
        
        return redirect('admin/requests');
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
        Requestsong::destroy($id);

        Session::flash('flash_message', 'Request deleted!');

        return redirect('admin/requests');
    }
}
