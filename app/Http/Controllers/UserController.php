<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view("users.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate( [
            "name"=> "required",
            "email"=> "email",
            "password"=> "required",
        ]);

        $user = User::create([
            "name"=> $request->name,
            "email"=> $request->email,
            "password" => $request->password,
        ]);

        return redirect()->route("user.index")->with("success","User created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        if($user){
            return view("users.update", compact("user"));
        }else{
            return redirect()->route("user.index")->with("error","User does not exist.");
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name"=> "required",
            "email"=> "email",
            "password"=> "required",
        ]);
        $user = User::find($id);
        if($user){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->save();

            return redirect()->route("user.index")->with("success","User updated successfully!");

        }else{
            return redirect()->route("user.index")->with("error","User does not exist.");
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if($user){
            $user->delete();
            return redirect()->route("user.index")->with("success","User updated successfully!");
        }else{
            return redirect()->route("user.index")->with("error","User does not exist.");
        }
    }
}
