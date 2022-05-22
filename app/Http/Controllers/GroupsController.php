<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Groups;
use App\Http\Request\Groups\storeRequest;
use App\Http\Request\Groups\updateRequest;


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
        }

        // If we dont have data we return a 400 HTTP CODE
        return response()->json(['message' => 'Error Ocurred', 'Data' => null],400);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeRequest $request)
    {

        if(Groups::create($request->validated())){
            //if we create a group we return a data and a 201 code
            return response()->json(['message' => 'Group Created', 'Data' => $request->all()],201);
        }

        //if we can't create a group we return a data null and a 400 code
        return response()->json(['message' => 'Error occured', 'Data'=> null],400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        return response()->json(['message' => 'Success', 'Data'=> $group],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateRequest $request, Group $group)
    {
        // if we find a group we tried to update it
        if($group->update($request->validated())){
            //if we can update it we return 200 and a Success message
            return response()->json(['message' => 'Group Updated', 'Data'=> $request->all()],200);
        }
        //in case we cant update we return a 400 and error message
        return response()->json(['message' => 'Error Ocurred', 'Data'=> null],400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //delete a group
        if(Groups::destroy($id)){
                //if we can update it we return 200 and a Success message
                return response()->json(['message' => 'Group Deleted'],200);
        }
        //in case we cant delete we return a 400 and error message
        return response()->json(['message' => 'Error Ocurred', 'Data'=> null],400);
    }
}
