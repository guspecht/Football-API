<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tvchannels;

class TvchannelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all Tvchannels
        $tvchannel = Tvchannels::all();
        if($tvchannel){
            //if we got data
            return response()->json(['message' => 'Success','Data' => $tvchannel],200);
        }else {
            //if we dont get data
            return response()->json(['message' => 'Error ocurred','Data' => null],400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate data First
        $this->validateTvchannels($request);

        if(Tvchannels::create($request->all())){
            //if we create a new Tv channel we return a 201 code
            return response()->json(['message' => 'Success','Data' => $request->all()],201);
        }else {
            // if we cant create a Tv channel we return 400 with a null data
            return response()->json(['message' => 'Error ocurred','Data' => null],400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return one tvchannel
        $tvchannel = Tvchannels::find($id);

        if($tvchannel){
            //if we found the tvchannel
            return response()->json(['message' => 'Success','Data' => $tvchannel],200);
        } else {
            // If we dont have data we return a 404 HTTP CODE - resource not found.
            return response()->json(['message' => 'Tvchannel not found - Check if you have the right ID','Data' => null],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validate data First
        $this->validateTvchannels($request);

        //Find the right channel
        $tvchannel = Tvchannels::find($id);

        if($tvchannel){
            //try to update the infomation
            if($tvchannel->update($request->all())){
                //if we find a tvchannel we return the data e code 200
                return response()->json(['message' => 'Success','Data' => $tvchannel],200);
            }else {
                // if we cant update a Tv channel we return 400 with a null data
                return response()->json(['message' => 'Error ocurred','Data' => null],400);
            }
        } else {
            // If we dont have data we return a 404 HTTP CODE - resource not found.
            return response()->json(['message' => 'Tvchannel not found - Check if you have the right ID','Data' => null],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tvchannel = Tvchannels::find($id);

        if($tvchannel){
           //try to delete a tvchannel
            if(Tvchannels::destroy($id)){
                //tv channel deleted
                return response()->json(['message' => 'Success'],200);
            }else {
                // if we cant delete a Tv channel we return 400 with a null data
                return response()->json(['message' => 'Error ocurred','Data' => null],400);
            }
        }else{
            // If we dont have data we return a 404 HTTP CODE - resource not found.
            return response()->json(['message' => 'Tvchannel not found - Check if you have the right ID','Data' => null],404);
        }
        
    }

    //Validate the request info
    protected function validateTvchannels(Request $request){
        // If validation fails, a redirect response will be generated to send the user back to their previous location. 
        //The errors will also be flashed to the session so they are available for display. If the request was an AJAX request, 
        //an HTTP response with a 422 status code will be returned to the user including a JSON representation of the validation errors.
        // this function was created in this Class
        return $request->validate([
            'name' => ['required', 'max:191'],
            'icon' => ['required', 'max:191'],
            'country' => ['required', 'max:191'],
            'iso2' => ['required'],
            'lang' => ['required']
        ]);
    }
}
