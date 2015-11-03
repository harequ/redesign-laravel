<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProjectsController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewProjectsList()
    {
        $projects = Project::all();
        $published = $projects->where('published', 1)->count();
        $unpublished = $projects->where('published', 0)->count();
        return view('dashboard.project.projects', compact('projects', 'published', 'unpublished'));
    }

    /**
     * Store a newly created Project in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveProject(Request $request)
    {

        // Validation for Add Project form
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required|unique:projects',
            'excerpt' => 'required',
            'body' => 'required',
            'thumbnail' => 'required',
            'link' => 'required',
            'href' => 'required',
            'pusblished' => 'boolean'
            ]);

        // Set all required fields for adding into the database
        $project = new Project;

        $project->title = $request->title;
        $project->slug = $request->slug;
        $project->excerpt = $request->excerpt;
        $project->body = $request->body;
        $project->link = $request->link;
        $project->href = $request->href;
        // Check if published field is selected set it to 1, overwise set it to 0 (because default unchecked value is NULL)
        $project->published = $request->published ? 1 : 0;

        // Verifying file presence
        if($request->hasFile('thumbnail')) {
            // get the file from the post request
            $file = $request->file('thumbnail');
            // set name for the thumbnail
            $thumbnailName = uniqid() . '-' . $file->getClientOriginalName();
            // move the file to images/projects_thumbnails folder 
            $file->move(public_path() . '/images/projects_thumbnails', $thumbnailName);
            // set the thumbnail field into the database
            $project->thumbnail = $thumbnailName; 
        }

        $project->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showProject($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
