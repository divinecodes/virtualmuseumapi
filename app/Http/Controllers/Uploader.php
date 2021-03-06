<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;
use URL;
use Log;


class Uploader extends Controller
{
    public function uploadImage(Request $request){
        $this->validate($request, [
            'image'=>'required|mimes:jpeg,bmp,jpg,png|between:1,
            6000'
        ]); 

        $image = $request->file('image'); 
        $name = $request->file('image')->getClientOriginalName();
        $image_name = $request->file('image')->getRealPath();
        
        try{
            Cloudder::upload($image_name,null);

            list($width, $height) = getimagesize($image_name);

            $image_url = Cloudder::show(Cloudder::getPublicId(), [
            "width"=>$width, "height"=>$height]);

            $image->move(public_path("uploads",$name));

            $response = array(
                'uploaded'=>true, 
                'url'=> $image_url
            );

            return $response;
        } catch (Exception $e){
            Log::debug($e);
            $response = array(
                'uploaded'=>false,
                'url'=>null,
            );

            return $response;
        }
    }

    public function uploadToLocal(Request $request){
        try{
            
            $image = 'vmuseum_uploaded_'.time().'.jpg';
    
            $request->file('image')->move(base_path().'/public/images/uploaded/',$image);
    
            //add user image to image url
            $url= URL::asset('/images/uploaded/'.$image);
            $response = array(
                    'uploaded'=>true, 
                    'url'=>$url
            );
            return $response;
        } catch (Exception $e){
            Log::debug($e); 
            $response = array(
                'uploaded'=>false,
                'url'=>null,
            );

            return $response; 
        }
    }
}
