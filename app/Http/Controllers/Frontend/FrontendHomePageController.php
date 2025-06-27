<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendHomePageController extends Controller
{
    public function landingPageView (){
        return view('frontend.index');
    }
}
