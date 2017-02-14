<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Feedback;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Input;
use DB;
use Validator;
use Auth;
use Carbon\Carbon;

class FeedbackController extends Controller
{
    public function __construct(){
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the authenticate method. We don't want to prevent
       // the user from retrieving their token if they don't already have it
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
        $feedback = Feedback::orderBy('id', 'desc')->paginate(25);

        return view('admin.feedback.index', compact('feedback'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.feedback.create');
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
        
        Feedback::create($requestData);

        Session::flash('flash_message', 'Feedback added!');

        return redirect('admin/feedback');
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
        $feedback = Feedback::findOrFail($id);

        $status = DB::table('feedback')->where('id',$id)->update(['status' => 1]);

        return view('admin.feedback.show', compact('feedback'));
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
        $feedback = Feedback::findOrFail($id);

        return view('admin.feedback.edit', compact('feedback'));
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
        
        $feedback = Feedback::findOrFail($id);
        $feedback->update($requestData);

        Session::flash('flash_message', 'Feedback updated!');

        return redirect('admin/feedback');
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
        Feedback::destroy($id);

        Session::flash('flash_message', 'Feedback deleted!');

        return redirect('admin/feedback');
    }
}
