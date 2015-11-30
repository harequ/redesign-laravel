<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Image;
use Storage;
use App\Illustration;

class IllustrationsController extends Controller
{

	public function __construct() {
        $this->middleware('auth');
    }

   public function showIllustrations() {
   		$illustrations = Illustration::latest()->get();
   		return view('dashboard/illustration/illustration', compact('illustrations'));
   }

   public function uploadIllustration(Request $request) {
	    if($request->hasFile('imgFile') && $request->alt) {
	        $image = $request->file('imgFile');
	        $imageNameOrigin = uniqid() . '-fullsize-' . $image->getClientOriginalName();
	        $imageNameThumb = uniqid() . '-thumb-' . $image->getClientOriginalName();
	        $illustrationPath = 'build/images/illustrations/';

	        if(!file_exists($illustrationPath)) {
	            Storage::disk('public')->makeDirectory($illustrationPath);     
	        }

	        $img = Image::make($image->getRealPath());
	        $img->save($illustrationPath . $imageNameOrigin);
	        $img->fit('320')->save($illustrationPath . $imageNameThumb);

	        $illustration = new Illustration;
	        $illustration->image = $imageNameOrigin; 
	        $illustration->thumb = $imageNameThumb; 
	        $illustration->alt = $request->alt;
	        $illustration->save();

	        return ['name' => asset('build/images/illustrations') . '/' . $imageNameThumb, 'img' => 'illustration'];
	    } else {
	        return 'error';
	    }
   }

   public function removeIllustration(Request $request) {
   		if($request->imageName) {
   		    $illustration = Illustration::where('thumb', $request->imageName)->firstOrFail();
   		    $illustrationPath = 'build/images/illustrations/';
   		    $imageNameOrigin = $illustration->image;
   		    $imageNameThumb = $illustration->thumb;

   		    Storage::disk('public')->delete($illustrationPath . $imageNameThumb);
   		    Storage::disk('public')->delete($illustrationPath . $imageNameOrigin);

   		    $illustration->delete();

   		    return 'ok';

   		} else {

   		    return 'failed';

   		}
   }
}
