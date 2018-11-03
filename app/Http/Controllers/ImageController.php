<?php

namespace App\Http\Controllers;

use App\Image;
use App\Http\Resources\Image as ImageResource;
use App\Http\Controllers\Uploader;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::orderBy('created_at','desc')->paginate(100);

        return ImageResource::collection($images);
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
        $image = new Image();
        $uploader = new Uploader(); 

        $image->location = $image->location; 
        $image->type = $image->type; 
        $image->order = $image->order; 
        $image->title = $image->title; 

        //start cloudinary integration
        $upload = $uploader->uploadImage($request);
        if(!$upload['uploaded']){
            return response()->json([
                'status'=>500,
                'error'=>'Unable to upload image', 
                'data'=>null
            ]);
        }
        $image->url =$upload['url'];
        if($image->save()){
            $data = new ImageResource($image);
            return response()->json([
                'status'=>200,
                'error'=>null,
                'data'=> $data
            ]);
        } else {
            return response()->json([
                'status'=>500,
                'error'=>'Unable to save image',
                'data'=>null]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $image = Image::where('id',$request->id)->first(); 

        if($image){
            $data = new ImageResource($image);
            return response()->json([
                'status'=>200,
                'error'=>null, 
                'data'=>$data
            ]);
        } else {
            return response()->json([
                'status'=>404,
                'error'=>"Image not found", 
                'data'=>null
            ]);
        }
    }

    /**
     * get images byy a specific location 
     * 
     * @param \Illuminate\Http\Request  $request
     */
    public function location(Request $request){
        $image = Image::where('location',$request->location)
            ->orderBy('order','desc')->get();
        if($image){
            $data = new ImageResource($image);
            return response()->json([
                'status'=>200, 
                'error'=>null, 
                'data'=>$data
            ]);
        } else {
            return response()->json([
                'status'=>404,
                'error'=>"Images in specific location not found",
                'data'=>null
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $image = Image::where('id',$request->id)->first(); 

        if($image){
            if($request->file('image')){
                $uploader = new Uploader(); 
                $upload = $uploader->uploadImage($request);
                if($upload['uploaded']){
                    $image->url = $upload['url'];
                }
            }

            $image->location = $request->location; 
            $image->type = $request->type; 
            $image->order = $request->order; 
            $image->title = $request->title;
            $image->updated_at = Carbon::now();

            if($image->update()){
                $data = new ImageResource($image); 
                return response()->json([
                    'status'=>200, 
                    'error'=>null, 
                    'data'=>$data
                ]);
            } else {
                return response()->json([
                    'status'=>500, 
                    'error'=> "Unable to update image",
                    'data'=>null
                ]);
            }
        } else {
            return response()->json([
                'status'=>404, 
                'error'=>"Image Not found",
                'data'=>null
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $image)
    {
        $image = Image::where('id',$request->id)->first(); 

        if($image && $image->delete()){
            return response()->json([
                'status'=>200,
                'error'=>null, 
                'data'=> 'deleted'
            ]);
        } else {
            return response()->json([
                'status'=>404,
                'error'=>'Image not found',
                'data'=> null
            ]);
        }
    }
}
