<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matches;

class MatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all matches
        $Matches = Matches::all();
        // create an array of matches
        $MatchesArray = array();
        
        foreach($Matches as $Match){
            
            if($Match){
                //if we find a match we need to find the channels that belongs to this match
                $channels = Matches::find($Match->id)->tvchannels;
                //create an array of channels id
                $channelsID = array();
                //add all IDs to the new channelsID array - we can return names here if we would like to.
                foreach($channels as $channel){
                    array_push($channelsID, $channel->id);
                }
                // add the channelsID array to the match so we can return the match with the array channels
                $Match['tvchannels'] = $channelsID;

                // add the new match with all tvchannel to the matchesarray
                array_push($MatchesArray, $Match);
            }else {
                //if we cant find a Match we return 400
                return response()->json(['message' => 'Error Ocurred', 'Data' => null],400);
            }
        }

        //if everything went well we will return 200 and the $MatchesArray with all matches and channels
        return response()->json(['message' => 'Success', 'Data' => $MatchesArray],200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate data
        $this->validateMatches($request);

        //Save the match
        $match = Matches::create($request->all());
        if($match){
            // add tv channels to a match - Many to many relation
            foreach($request->tvchannels as $tvchannel){
                $match->tvchannels()->attach($tvchannel);
            }
            //if we create a Match we return a 201 code
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
        // Get one match
        $Match = Matches::find($id);
        
        if($Match){
            
            //if we find a match we need to find the channels that belongs to this match
            $channels = Matches::find($id)->tvchannels;
            //create an array of channels id
            $channelsID = array();
            //add all IDs to the new channelsID array - we can return names here if we would like to.
            foreach($channels as $channel){
                array_push($channelsID, $channel->id);
            }
            // add the channelsID array to the match so we can return the match with the array channels
            $Match['tvchannels'] = $channelsID;

            //if everything went well we will return 200
            return response()->json(['message' => 'Success', 'Data' => $Match],200);
        }else {
            //if we cant find a Match we return 404
            return response()->json(['message' => 'Match not found - Check if you have the right ID', 'Data' => null],404);
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
        //validate data
        $this->validateMatches($request);

        $match = Matches::find($id);
        
        if($match){

            // Detach all tvchannel from the match...
            $match->tvchannels()->detach();

            //create an array of channels id
            $channelsID = array();
            
            //add all IDs to the new channelsID array - we can return names here if we would like to.
            foreach($request->tvchannels as $channel){
                array_push($channelsID, $channel);
            }
            
            // add tv channels to a match - Many to many relation
            foreach($request->tvchannels as $tvchannel){
                $match->tvchannels()->attach($tvchannel);
            }

            // update the match
            $match->update($request->all());

            // add the channelsID array to the match so we can return the match with the array channels
            $match['tvchannels'] = $channelsID;

            //if everything went well we will return 200
            return response()->json(['message' => 'Success', 'Data' => $match],200);
        }else {
            //if we cant find a Match we return 404
            return response()->json(['message' => 'Match not found - Check if you have the right ID', 'Data' => null],404);
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

        // Delete a match
        $Matche = Matches::find($id);

        if($Matche){
            if(Matches::destroy($id)){
                //if we deleted it we return 200
                return response()->json(['message' => 'Success'],200);
            }else {
                //if we cant delete it a stadium we return 400
                return response()->json(['message' => 'Error Ocurred', 'Data' => null],400);
            }

        }else {
                //if we cant find a stadium we return 404
                return response()->json(['message' => 'Match not found - Check if you have the right ID', 'Data' => null],404);
            }
    }

    protected function validateMatches(Request $request){
        // If validation fails, a redirect response will be generated to send the user back to their previous location. 
        //The errors will also be flashed to the session so they are available for display. If the request was an AJAX request, 
        //an HTTP response with a 422 status code will be returned to the user including a JSON representation of the validation errors.
        // this functions was created in this Class
        return $request->validate([
            'name' => 'required',
            'home_team' => 'required',
            'away_team' => 'required',
            'home_result' => 'required',
            'away_result' => 'required',
            'date' => 'required',
            'match_type' => 'required',
            'stadiums_id' => 'required',
            'groups_id' => 'required',
            'tvchannels' => 'required'
        ]);
    }
}
