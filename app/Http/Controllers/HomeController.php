<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Image;
use App\Location;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::orderBy('created_at','desc')->paginate(30);
        $locations = Location::orderBy('location','asc')->get(); 
        return view('home',[
            'images'=>$images,
            'locations'=>$locations
        ]);
    }


    public function locations(){
        $locations = Location::orderBy('location','asc')->get(); 

        return view('location',[
            'locations'=>$locations
        ]);
    }
}
