<?php

namespace App\Http\Controllers;

use App\Video;
use App\Http\Resources\Video as VideoResource; 
use Illuminate\Http\Request;

class VideoController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::orderBy('created_at','desc')->paginate(100);

        return VideoResource::collection($videos);
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
        $video = new Video(); 

        $video->location = $video->location; 
        $video->type = $video->type; 
        $video->order = $video->order; 
        $video->title = $video->title; 

        //start cloudinary integration 
        $url = "hello";
        $video->url = $url;
        if($video->save()){
            $data = new VideoResource($video);
            return response()->json([
                'status'=>200,
                'error'=>null,
                'data'=> $data
            ]);
        } else {
            return response()->json([
                'status'=>500,
                'error'=>'Unable to save video',
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
        $video = Video::where('id',$request->id)->first(); 

        if($video){
            $data = new VideoResource($video);
            return response()->json([
                'status'=>200,
                'error'=>null, 
                'data'=>$data
            ]);
        } else {
            return response()->json([
                'status'=>404,
                'error'=>"Video not found", 
                'data'=>null
            ]);
        }
    }

    /**
     * get videos byy a specific location 
     * 
     * @param \Illuminate\Http\Request  $request
     */
    public function location(Request $request){
        $video = Video::where('location',$request->location)
            ->orderBy('order','desc')->get();
        if($video){
            $data = new VideoResource($video);
            return response()->json([
                'status'=>200, 
                'error'=>null, 
                'data'=>$data
            ]);
        } else {
            return response()->json([
                'status'=>404,
                'error'=>"Videos in specific location not found",
                'data'=>null
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
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
        $video = Video::where('id',$request->id)->first(); 

        if($video){
            if($request->file('video')){
                //TODO: iniitialize cloudinary integration
                
            }

            $video->location = $request->location; 
            $video->type = $request->type; 
            $video->order = $request->order; 
            $video->title = $request->title;
            $video->updated_at = Carbon::now();

            if($video->update()){
                $data = new VideoResource($video); 
                return response()->json([
                    'status'=>200, 
                    'error'=>null, 
                    'data'=>$data
                ]);
            } else {
                return response()->json([
                    'status'=>500, 
                    'error'=> "Unable to update video",
                    'data'=>null
                ]);
            }
        } else {
            return response()->json([
                'status'=>404, 
                'error'=>"Video Not found",
                'data'=>null
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $video)
    {
        $video = Video::where('id',$request->id)->first(); 

        if($video && $video->delete()){
            return response()->json([
                'status'=>200,
                'error'=>null, 
                'data'=> 'deleted'
            ]);
        } else {
            return response()->json([
                'status'=>404,
                'error'=>'Video not found',
                'data'=> null
            ]);
        }
    }
}
