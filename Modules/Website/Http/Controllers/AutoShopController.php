<?php

namespace Modules\Website\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


class AutoShopController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    
    public function index(){
    	return view('website::auto-shop.index');
    }
}
      