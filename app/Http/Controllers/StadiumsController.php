<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stadiums;

class StadiumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // Get all Stadiums
        $stadium = Stadiums::all();
        if($stadium){
            return response()->json(['message' => 'Success', 'Data' => $stadium],200);
        }else {
            return response()->json(['message' => 'Error Ocurred', 'Data' => null],400);
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
        //Validate data first
        $this->validateStadium($request);

        if(Stadiums::create($request->all())){
            //if we create a stadium we return a 201 code
            return response()->json(['message' => 'Success', 'Data' => $request->all()],201);
        }else {
            //if we cant create a stadium we return 400
            return response()->json(['message' => 'Error Ocurred', 'Data' => null],400);
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
        // Get one stadium
        $stadium = Stadiums::find($id);

        if($stadium){
            //if we find we return 200
            return response()->json(['message' => 'Success', 'Data' => $stadium],200);
        }else {
            //if we cant find a stadium we return 404
            return response()->json(['message' => 'Stadium not found - Check if you have the right ID', 'Data' => null],404);
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
        $this->validateStadium($request);

        // update a stadium
        $stadium = Stadiums::find($id);

        if($stadium){
            if($stadium->update($request->all())){
                //if we find we return 200
                return response()->json(['message' => 'Success', 'Data' => $request->all()],200);
            }else {
                //if we cant update a stadium we return 400
                return response()->json(['message' => 'Error Ocurred', 'Data' => null],400);
            }
        }else{
            //if we cant find a stadium we return 404
            return response()->json(['message' => 'Stadium not found - Check if you have the right ID', 'Data' => null],404);
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
        // Delete a stadium
        $stadium = Stadiums::find($id);

        if($stadium){
            if(Stadiums::destroy($id)){
                //if we deleted it we return 200
                return response()->json(['message' => 'Success'],200);
            }else {
                //if we cant delete it a stadium we return 400
                return response()->json(['message' => 'Error Ocurred', 'Data' => null],400);
            }

        }else {
             //if we cant find a stadium we return 404
             return response()->json(['message' => 'Stadium not found - Check if you have the right ID', 'Data' => null],404);
            }
        
    }

    //Validate the request info
    protected function validateStadium(Request $request){
        // If validation fails, a redirect response will be generated to send the user back to their previous location. 
        //The errors will also be flashed to the session so they are available for display. If the request was an AJAX request, 
        //an HTTP response with a 422 status code will be returned to the user including a JSON representation of the validation errors.
        // this functions was created in this Class
        return $request->validate([
            'name' => ['required', 'min:3', 'max:191'],
            'city' => ['required', 'min:3'],
            'lat' => ['required'],
            'image' => ['required'],
            'lng' => ['required']
        ]);
    }
}
