<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Page;
use Illuminate\Http\Request;
use Session;

use Illuminate\Support\Facades\Input;
use DB;
use Validator;
use Carbon\Carbon;


class PagesController extends Controller
{
     public function __construct(){
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the authenticate method. We don't want to prevent
       // the user from retrieving their token if they don't already have it
      // $this->middleware('jwt.auth', ['except' => ['authenticate']]);
       date_default_timezone_set("Asia/Bangkok");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        //$pages = Page::paginate(25);

        //return view('web.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('web.pages.create');
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
        
        Page::create($requestData);

        Session::flash('flash_message', 'Page added!');
        Session::flash('flash_class', 'alert-success');
        return redirect('web/pages');
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
         return view('web.pages.show', compact('page'));
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

        return view('web.pages.edit', compact('page'));
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
        
        $page = Page::findOrFail($id);
        $page->update($requestData);

         Session::flash('flash_message', 'Page updated!');
         Session::flash('flash_class', 'alert-success');
        return redirect('web/pages');
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
        return redirect('web/pages');
    }
}
