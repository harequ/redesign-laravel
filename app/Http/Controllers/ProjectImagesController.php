<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Image;
use Storage;
use App\Project;
use App\ProjectImage;

class ProjectImagesController extends Controller
{
    public function uploadImage(Request $request, $id) {

    	$project = Project::findOrFail($id);
 
    	// Checking if there is a file in request
        if($request->hasFile('imgFile') && $request->alt) {
            $image = $request->file('imgFile');
            $imageNameOrigin = uniqid() . '-fullsize-' . $image->getClientOriginalName();
            $imageNameThumb = uniqid() . '-thumb-' . $image->getClientOriginalName();
            $projectPath = 'build/images/projects/' . $project->slug . '/';
            $imageNameThousand = '';

            if(!file_exists($projectPath)) {
                Storage::disk('public')->makeDirectory($projectPath);     
            }

            $img = Image::make($image->getRealPath());
            $image->move($projectPath, $imageNameOrigin);
            if($img->width() > 980) {
                $imageNameThousand = uniqid() . '-thousand-' . $image->getClientOriginalName();
                $img->resize(980, null, function ($constraint) {
                    $constraint->aspectRatio();
               })->save($projectPath . $imageNameThousand, 95); 
            }
            $img->fit('400')->save($projectPath . $imageNameThumb);
            // save into database
            $projectImage = new ProjectImage;
            $projectImage->project_id = $project->id;
            $projectImage->img_thumb = $imageNameThumb; 
            $projectImage->img_origin = $imageNameOrigin; 
            if($imageNameThousand) {
                $projectImage->img_thousand = $imageNameThousand; 
            }
            $projectImage->alt = $request->alt;

            $projectImage->save();

            return ['name' => asset('build/images/projects') . '/' . $project->slug . '/' . $imageNameThumb, 'img' => 'projectImage'];
        } else {
            return 'error';
        }
    }

    public function removeImage(Request $request, $slug) {

        if($request->imageName) {
            $projectImage = ProjectImage::where('img_thumb', $request->imageName)->firstOrFail();
            $projectPath = 'build/images/projects/' . $slug . '/';
            $thumbnail = $projectImage->img_thumb;
            $imgOrigin = $projectImage->img_origin;
            if($projectImage->img_thousand != null) {
                $imgThousand = $projectImage->img_thousand;
            }

            // removing images from disk
            Storage::disk('public')->delete($projectPath . $thumbnail);
            Storage::disk('public')->delete($projectPath . $imgOrigin);
            if(isset($imgThousand)) {
                Storage::disk('public')->delete($projectPath . $imgThousand);
            }

            // removing table row from database
            $projectImage->delete();

            return 'ok';
        } else {
            return 'failed';
        }
    }
}