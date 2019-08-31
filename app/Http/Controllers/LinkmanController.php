<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LinkmanController extends Controller
{
    public function linkman(){
    	return view('linkman.linkman');
    }
}
