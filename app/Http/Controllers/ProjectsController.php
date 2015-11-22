<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Image;
use Storage;
use App\Project;
use App\ProjectRole;

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
        $projectRoles = ProjectRole::lists('name', 'id');
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
            $file = $request->file('thumbnail');
            $thumbName = uniqid(). '-' . $file->getClientOriginalName();
            $projectPath = 'images/projects/' . $project->slug . '/';
            if(!file_exists($projectPath)) {
                Storage::disk('public')->makeDirectory($projectPath);   
            }

            $thumb = Image::make($request->file('thumbnail')->getRealPath());
            $thumb->fit(410, 277)->save($projectPath . $thumbName);

            // set the thumbnail field into the database
            $project->thumbnail = $thumbName; 
        }

        $project->save();

        // Add project roles to current project in pivot table.
        $project->projectRoles()->sync($request->list);

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function editProject($slug)
    {
        $projectRoles = ProjectRole::lists('name', 'id');
        $project = Project::where('slug', $slug)->firstOrFail();
        $project->projectRoles;
        $projectImages = $project->projectImages;
        return view('dashboard.project.edit', compact('project', 'projectRoles', 'projectImages'));   
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
            $file = $request->file('thumbnail');
            $thumbName = uniqid() . '-' . $file->getClientOriginalName();
            $projectPath = 'images/projects/' . $project->slug . '/';
            if(!file_exists($projectPath)) {
                Storage::disk('public')->makeDirectory($projectPath);
                // mkdir($projectPath, 0777, true);     
            }

            $thumb = Image::make($request->file('thumbnail')->getRealPath());
            $thumb->fit(410, 277)->save($projectPath . $thumbName);

            // remove the old image from images/projects_thumbnails folder
            Storage::disk('public')->delete($projectPath . $project->thumbnail);
            // unlink($projectPath . $project->thumbnail);
            // set the updated thumbnail field into the database
            $project->thumbnail = $thumbName; 
        }

        $project->save();

        $project->projectRoles()->sync($request->list);

        session()->flash('update_message', 'The Project has been updated successfully!');

        return redirect('dashboard/projects/' . $project->slug . '/edit');
    }   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function deleteProject($slug)
    {
        $project = Project::where('slug', $slug);
        $projectPath = 'images/projects/' . $slug . '/';
        Storage::disk('public')->deleteDirectory($projectPath);
        $project->delete();
        return redirect('dashboard/projects/');
    }
}
