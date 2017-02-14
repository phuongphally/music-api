<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Page;
use Illuminate\Http\Request;
use Session;

class PagesController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id){

        $page = Page::findOrFail($id);
        return Response()->json($page);
    }

   
}
