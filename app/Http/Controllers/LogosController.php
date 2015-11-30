<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Image;
use Storage;
use App\Logo;

class LogosController extends Controller
{
   public function __construct() {
        $this->middleware('auth');
    }

   public function showLogos() {
   	$logos = Logo::latest()->get();
		return view('dashboard/logo/logo', compact('logos'));
   } 

   public function uploadLogo(Request $request) {
   	if($request->hasFile('imgFile') && $request->alt) {
      	$logo = $request->file('imgFile');
         $logoName = uniqid() . '-logo-' . $logo->getClientOriginalName();
        	$logoThumb = uniqid() . '-thumb-' . $logo->getClientOriginalName();
        	$logoPath = 'build/images/logos/';

        	if(!file_exists($logoPath)) {
            Storage::disk('public')->makeDirectory($logoPath);     
        	}

        	$img = Image::make($logo->getRealPath());
        	$img->save($logoPath . $logoName);
         $img->fit('230')->save($logoPath . $logoThumb);

        $logo = new Logo;
        $logo->image = $logoName; 
        $logo->thumb = $logoThumb; 
        $logo->alt = $request->alt;
        $logo->save();

		  return ['name' => asset('build/images/logos') . '/' . $logoThumb, 'img' => 'illustration'];
		} else {
		  return 'error';
		}
   }

   public function removeLogo(Request $request) {
		if($request->imageName) {
			$logo = Logo::where('thumb', $request->imageName)->firstOrFail();
			$logoPath = 'build/images/logos/';
			$logoName = $logo->image;
      $logoThumb = $logo->thumb;

      Storage::disk('public')->delete($logoPath . $logoName);
			Storage::disk('public')->delete($logoPath . $logoThumb);

			$logo->delete();

			return 'ok';
		} else {
			return 'failed';
		}
   }
}
