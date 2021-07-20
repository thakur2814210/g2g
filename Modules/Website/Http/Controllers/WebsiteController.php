<?php

namespace Modules\Website\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Faq;
use App\ContactUs;

class WebsiteController extends Controller
{
   	// Language Switch...
     public function switchLang($lang)
     {
        session(['applocale' => $lang]);
        return \Redirect::back();
     } 

    
}
