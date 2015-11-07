<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Image;
use App\Project;

class ProjectImagesController extends Controller
{
    public function uploadImage(Request $request, $id) {

    	$project = Project::findOrFail($id);
 
    	// Checking if there is a file in request
        if($request->hasFile('imgFile')) {
            // get the file from the post request
            $image = $request->file('imgFile');
            // set the name for the image
            $imageName = uniqid() . '-original-' . $image->getClientOriginalName();
            // set the folder for the image 
            $projectPath = public_path() . '/images/projects/' . $project->slug . '/';
            // if project folder doesn't exist, create it
            if(!file_exists($projectPath)) {
                mkdir($projectPath, 0777, true);     
            }

            // give a temporary_file_path to method Image::make()
            $img = Image::make($image->getRealPath());
            $img->save($projectPath . $imageName);

            // set the thumbnail field into the database
            // $project->thumbnail = $thumbName; 
            return ['name' => '/images/projects/' . $project->slug . '/' . $imageName];
        }
    }
}
