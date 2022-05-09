<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matches;
use App\Models\Groups;
use App\Models\Teams;
use App\Models\Stadiums;


class FootballController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // i need to return everything and i will return tvchannels inside of the matches
        //i just started!


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
                return response()->json(['message' => 'Match not found - Check if you have the right ID', 'Data' => null],400);
            }
        }

        $stadium = Stadiums::all();
        $team = Teams::all();
        $group = Groups::all();

        //if everything went well we will return 200 and the $MatchesArray with all matches and channels
        return response()->json(['message' => 'Success', 'Football' => ['Teams' => $team, 'Groups' => $group, 'Stadiums' => $stadium, 'Matches' => $MatchesArray] ],200);
    }

}
