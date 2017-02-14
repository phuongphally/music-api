<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Page;
use Illuminate\Http\Request;
use Session;

use Illuminate\Support\Facades\Input;
use DB;
use Validator;
use Carbon\Carbon;
use Auth;



class PagesController extends Controller
{
    public function __construct(){
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the authenticate method. We don't want to prevent
       // the user from retrieving their token if they don't already have it
      // $this->middleware('jwt.auth', ['except' => ['authenticate']]);
       date_default_timezone_set("Asia/Bangkok");
       $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pages = Page::paginate(25);

        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.pages.create');
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
        

        $title = $request->input('title');
        $content = $request->input('content');
        $slug =  str_slug($title, "-");
        
        Page::create([
        'title' => $title,
        'content' => $content,
        'slug' => $slug,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
         ]);
        Session::flash('flash_message', 'Page added!');
        Session::flash('flash_class', 'alert-success');
        return redirect('admin/pages');
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
        $page = DB::table('pages') ->select('id','title','slug','content')->where('slug', $id)->get();
        return view('admin.pages.show', compact('page'));
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
        $page = Page::findOrFail($id);

        return view('admin.pages.edit', compact('page'));
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
        $title = $request->input('title');
        $content = $request->input('content');
        $slug =  str_slug($title, "-");
        $data =  array(
          'title' => $title,
          'content' => $content,
          'slug' => $slug,
          'updated_at' => Carbon::now(),
         );
         $page = DB::table('pages')->where('id',$id)->update($data);
         Session::flash('flash_message', 'Page updated!');
         Session::flash('flash_class', 'alert-success');
        return redirect('admin/pages');
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
        Page::destroy($id);

         Session::flash('flash_message', 'Page deleted!');
         Session::flash('flash_class', 'alert-success');
        return redirect('admin/pages');
    }
}
