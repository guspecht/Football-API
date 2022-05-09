<?php

namespace App\Http\Controllers;

use App\Models\Teams;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all teams
        $team = Teams::all();
        if($team){
            // Return all the teams with a Success message and code 200
            return response()->json(['message'=>'Success','Data' => $team],200);
        }else{
            // If we dont have data we return a 400 HTTP CODE.
            return response()->json(['message' => 'Error Ocurred', 'Data' =>null],400);
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
        $this->validateTeam($request);

        if(Teams::create($request->all())){
            //if team is created a 201 HTTP CODE will be return with the $request information
            return response()->json(['message'=>'Team Created','Data' => $request->all()],201);
        } else {
            return response()->json(['message'=>'Error Occured', 'Data' =>null],400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teams  $teams
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return an especific team
        $team = Teams::find($id);
        if($team){
            //if team has data so we return a message and the data with a 200 HTTP CODE
            return response()->json(['message' => 'Success',$this->className => $team],200);
        } else {
            // If we dont have data we return a 404 HTTP CODE - resource not found.
            return response()->json(['message' => 'Team not found', 'Data' =>null],404);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teams  $teams
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validate data First
        $this->validateTeam($request);

        // Find the team that you would like to update
        $team = Teams::find($id);

        // Check if we have a team
        if($team){

            //if we have a team it tries to update the team
            if($team->update($request->all())){
                // if it does update the team it will return a 200
                return response()->json(['message'=>'Team updated','Data' => $request->all()],200);
            } else {
                //if it does not update the team it will return a 400
                return response()->json(['message'=>'Error Occured', 'Data' => null],400);
            }

        } else {
            // if we dont have a team returns a 404 error 
            return response()->json(['message'=>'Team not found - Check if you have the right ID'],404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teams  $teams
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Find team first
        $team = Teams::find($id);

        if($team){
            //delete the team
            if(Teams::destroy($id)){
                //if we deleted the team it returns HTTP CODE 200
                return response()->json(['message'=>'Team deleted'],200);
            } else {
                //if we cant delete return 400
                return response()->json(['message'=>'Error Occured', 'Data' =>null],400);
            }
        }else {
            //if does not a team ID return 404
            return response()->json(['message'=>'Team not found - Check if you have the right ID'],404);
        }
    }

    //Validate the request info
    protected function validateTeam(Request $request){
        // If validation fails, a redirect response will be generated to send the user back to their previous location. 
        //The errors will also be flashed to the session so they are available for display. If the request was an AJAX request, 
        //an HTTP response with a 422 status code will be returned to the user including a JSON representation of the validation errors.
        // this function was created in this Class
       return $request->validate([
            'name' => ['required', 'max:191'],
            'fifaCode' => ['required', 'max:191'],
            'iso2' => ['required', 'max:191'],
            'flag' => ['required', 'max:191'],
            'emoji' => ['required', 'max:191'],
            'groups_id' => ['required']
        ]);
    }


}
