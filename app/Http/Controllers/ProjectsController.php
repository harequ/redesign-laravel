<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Image;
use App\Project;

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
        $projects = Project::latest()->get();
        $published = $projects->where('published', 1)->count();
        $unpublished = $projects->where('published', 0)->count();
        $projectRoles = \App\ProjectRole::lists('name', 'id');
        return view('dashboard.project.projects', compact('projects', 'published', 'unpublished', 'projectRoles'));
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
            'list' => 'required',
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


        // Checking if there is a file in request
        if($request->hasFile('thumbnail')) {
            // get the file from the post request
            $file = $request->file('thumbnail');
            // set the name for the thumbnail
            $thumbName = 'tn-' . $file->getClientOriginalName();
            // set the project folder path
            $projectPath = public_path() . '/images/projects/' . $project->slug . '/';
            // if project folder doesn't exist, create it
            if(!file_exists($projectPath)) {
                mkdir($projectPath, 0777, true);     
            }

            // give a temporary file path to the method make()
            $thumb = Image::make($request->file('thumbnail')->getRealPath());
            $thumb->fit(410, 277)->save($projectPath . $thumbName);

            // set the thumbnail field into the database
            $project->thumbnail = $thumbName; 
        }

        $project->save();

        // Add project roles to current project.
        $project->projectRoles()->sync($request->list);

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
    public function editProject($slug)
    {
        $projectRoles = \App\ProjectRole::lists('name', 'id');
        $project = Project::where('slug', $slug)->firstOrFail();
        $project->projectRoles;
        return view('dashboard.project.edit', compact('project', 'projectRoles'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProject(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'link' => 'required',
            'href' => 'required',
            'list' => 'required',
            'pusblished' => 'boolean'
        ]);

        $project = Project::findOrFail($id);

        $project->title = $request->title;
        $project->slug = $request->slug;
        $project->excerpt = $request->excerpt;
        $project->body = $request->body;
        $project->link = $request->link;
        $project->href = $request->href;
        // Check if published field is selected set it to 1, overwise set it to 0 (because default unchecked value is NULL)
        $project->published = $request->published ? 1 : 0;


        // Checking if there is a file in request
        if($request->hasFile('thumbnail')) {
             // get the file from the post request
            $file = $request->file('thumbnail');
            // set the name for the thumbnail
            $thumbName = 'tn-' . $file->getClientOriginalName();
            // set the project folder path
            $projectPath = public_path() . '/images/projects/' . $project->slug . '/';
            // if project folder doesn't exist, create it
            if(!file_exists($projectPath)) {
                mkdir($projectPath, 0777, true);     
            }

            // give a temporary file path to the method make()
            $thumb = Image::make($request->file('thumbnail')->getRealPath());
            $thumb->fit(410, 277)->save($projectPath . $thumbName);

            // remove the old image from images/projects_thumbnails folder
            unlink($projectPath . $project->thumbnail);

            // set the updated thumbnail field into the database
            $project->thumbnail = $thumbName; 
        }

        $project->save();

        // Add project roles to current project.
        $project->projectRoles()->sync($request->list);

        // Flash message
        session()->flash('update_message', 'The Project has been updated successfully!');

        return redirect('dashboard/projects/' . $project->slug . '/edit');
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
