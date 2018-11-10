<?php

namespace App\Http\Controllers;

use App\Location;
use App\Http\Resources\Location as LocationResource; 
use Illuminate\Http\Request;
use App\Http\Controllers\Uploader;
use App\Http\Controllers\Helper;
use Carbon\Carbon; 

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Locations::orderBy('location','desc')->get();

        return LocationResource::collection($locations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $location = new Location; 
        $uploader = new Uploader();
        $helper = new Helper(); 

        $location->location = $request->location; 
        $location->about = $request->about;

        $url = "";
        if($helper->is_connected()){
           $upload = $uploader->uploadImage($request);
           if($upload['uploaded']){
               $url = $upload['url'];
           } else {
                return response()->json([
                    'status'=>500,
                    'error'=>'Unable to Upload Image To Cloudinary', 
                    'data'=>null
                ]);
           }
        } else {
            $upload = $uploader->uploadToLocal($request);
            if($upload['uploaded']){
                $url = $upload['url'];
            } else {
                return response()->json([
                    'status'=>500,
                    'error'=>'Unable to Upload Image To Local', 
                    'data'=>null
                ]);
            }
        }

        $location->image = $url; 

        if($location->save()){
            $data = new LocationResource($location);
            return response()->json([
                'status'=>200, 
                'error'=>null, 
                'data'=> $data
            ]);
        } else {
            return response()->json([
                'status'=> 500,
                'error'=>"Unable to add Location",
                'data'=>null
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $location = Location::where('id',$request->id)->first(); 

        if($location){
            $data = new LocationResource($location);

            return response()->json([
                'status'=>200,
                'error'=>null, 
                'data'=>$data
            ]);
        } else {
            return response()->json([
                'status'=>404, 
                'error'=>'Location Not Found',
                'data'=>null
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $location = Location::where('id',$request->id)->first(); 

        if($location && $location->delete()){
            return response()->json([
                'status'=>200, 
                'error'=>null,
                'data'=>'deleted'
            ]);
        } else {
            return response()->json([
                'status'=>500, 
                'error'=>'Unable to delete location',
                'data'=>null
            ]);
        }
    }
}
