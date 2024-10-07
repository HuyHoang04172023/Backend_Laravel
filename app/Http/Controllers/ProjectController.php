<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Project;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->user()->can("viewAny",[User::class,'admin'])){

            $projects = Project::all();

            return view("projects.index", compact("projects"));
        }

        abort(403, 'Unauthorized action.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("projects.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate( [
            "name"=> "required",
        ]);
        Project::create([
            "name"=> $request->name
        ]);
        return redirect()->route("project.index")->with("success","Project created successfully!");
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
        $project = Project::find($id);
        if($project){
            return view("projects.update", compact("project"));
        }else{
            return redirect()->route("")->with("error","");
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate( [
            "name"=> "required",
        ] );
        $project = Project::find($id);

        if($project){
            $project->name = $request->name;
            $project->save();

            return redirect()->route("project.index")->with("success","Project updated successfully!");
        }else{
            return redirect()->route("project.index")->with("error","Project does not exist.");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::find($id);
        if($project){
            $project->delete();

            return redirect()->route("project.index")->with("success","Project deleted successfully!");
        }else{
            return redirect()->route("project.index")->with("error","Project does not exist.");
        }
    }
}
