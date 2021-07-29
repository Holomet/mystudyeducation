<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Collage;
use App\Models\CollageZone;

class HomeController extends Controller
{
    public function index()
    {
    	$role = \Auth::user()->role_id;
    	if($role==1)
    	{
    		return view('admin.home.dashboard');
    	}else{
    		$collages 		=	Collage::where('user_id', \Auth::user()->id)->get();
    		if(count($collages)){
    			return view('admin.home.collage')->with(compact('collages'));	
    		}
    		else{
    			return view('admin.home.nocollege');
    		}
    	}
    }
}
