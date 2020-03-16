<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->role == "user"){
            return response()->json(["message" => "You have no permission to do this"], 403);
        }
        $users = User::all();
        foreach ($users as $user){
            $user->api_token=null;
        }
        return response()->json($users);
    }

    public function show($id)
    {
        if (auth()->user()->role != "admin"){
            return response()->json(["message" => "You have no permission to do this"], 403);
        }
        $user = User::findOrFail($id);
        $user->api_token=null;
        return response()->json($user);
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
        if (auth()->user()->role != "admin"){
            return response()->json(["message" => "You have no permission to do this"], 403);
        }
        $user = User::findOrFail($id);
        if (!isset($request->role)){
            return response()->json(["message"=>"This method only allows you to edit the role. You need to pass role"]);
        }
        $user->role=$request->role;
        $user->save();

        return response()->json($user, 200);
    }
}
