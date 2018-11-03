<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Helper;
use App\Http\Controllers\ImageController;

class ApiWrapper extends Controller
{
    /**
     * just because i am too lazy to do http requests
     * simple wrapper class to encapsulate the api
     *  
     * NOTE THIS wrapper might get very long
     * TODO: INITIALIZE API KEY AND PASS TO THE FUNCTION
     */
    public function __construct(){
        $this->middleware('auth');
        $this->helper = new Helper();
    }

    /**
     * wrap the logic of adding an image 
     * 
     * @param Request $request
     * 
     * @return Illuminate\Http\Response;
     */
    public function addImage(Request $request){
        $image = new ImageController(); 
        $response = $image->store($request);

        return redirect()->back()->with([
            'status'=>$this->helper->curlHeaderStatus($response), 
            'error'=> $this->helper->curlHeaderError($response)
        ]);
    }

    /**
     * update an image details 
     * 
     * @param Request $request 
     * 
     * @return Illuminate\Http\Response
     */
    public function updateImage(Request $request){
        $image = new ImageController(); 
        $response = $image->update($request);

        return redirect()->back()->with([
            'status'=>$this->helper->curlHeaderStatus($response), 
            'error'=> $this->helper->curlHeaderError($response)
        ]);
    }

    /**
     * delete an image details 
     * 
     * @param Request $request 
     * 
     * @return Illuminate\Http\Response
     */
    public function deleteImage(Request $request){
        $image = new ImageController(); 
        $response = $image->destroy($request);

        return redirect()->back()->with([
            'status'=>$this->helper->curlHeaderStatus($response),
            'error'=>$this->helper->curlHeaderError($response)
        ]);
    }
}
