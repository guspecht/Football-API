<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Groups;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return all groups
        $group = Groups::all();
        
        if($group){
            //Return all groups with HTTP CODE 200
            return response()->json(['message' => 'Success' ,'Data' => $group ], 200);
        }else {
            // If we dont have data we return a 400 HTTP CODE
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
        //Validate data First
        $this.validateGroup($request);

        if(Groups::create($request->all())){
            //if we create a group we return a data and a 201 code
            return response()->json(['message' => 'Group Created', 'Data' => $request->all()],201);
        }else{
            //if we can't create a group we return a data null and a 400 code
            return response()->json(['message' => 'Error occured', 'Data'=> null],400);
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
        //get one group by id
        $group = Groups::find($id);

        //check if we found a group
        if($group){
            //in case we do find a group we return the data and code 200
            return response()->json(['message' => 'Success', 'Data'=> $group],200);
        }else {
            // in case we did not find the group we return 404
            return response()->json(['message' => 'Group not found - Check if you have the right ID', 'Data'=> null],404);
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
        $this.validateGroup($request);


        $group = Groups::find($id);

        if($group){
            // if we find a group we tried to update it
           if($group->update($request->all())){
                //if we can update it we return 200 and a Success message
                return response()->json(['message' => 'Group Updated', 'Data'=> $request->all()],200);
           }else{
                //in case we cant update we return a 400 and error message
                return response()->json(['message' => 'Error Ocurred', 'Data'=> null],400);
           }
        }else{
            // in case we did not find the group we return 404
            return response()->json(['message' => 'Group not found', 'Data'=> null],404);
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
        

        $group =  Groups::find($id);

        if($group){
            //delete a group
            if(Groups::destroy($id)){
                 //if we can update it we return 200 and a Success message
                 return response()->json(['message' => 'Group Deleted'],200);
            }else{
                //in case we cant delete we return a 400 and error message
                return response()->json(['message' => 'Error Ocurred', 'Data'=> null],400);
            }

        }else{
            // in case we did not find the group we return 404
            return response()->json(['message' => 'Group not found', 'Data'=> null],404);
        }


    }


    //Validate the request info
    protected function validateGroup(Request $request){
        // If validation fails, a redirect response will be generated to send the user back to their previous location. 
        //The errors will also be flashed to the session so they are available for display. If the request was an AJAX request, 
        //an HTTP response with a 422 status code will be returned to the user including a JSON representation of the validation errors.
        // this functions was created in this Class
        return $request->validate([
             'name' => ['required', 'max:191'],
         ]);
     }
}
