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
   public function showLogos() {
   	$logos = Logo::latest()->get();
		return view('dashboard/logo/logo', compact('logos'));
   } 

   public function uploadLogo(Request $request) {
   	if($request->hasFile('imgFile') && $request->alt) {
      	$logo = $request->file('imgFile');
        	$logoName = uniqid() . '-logo-' . $logo->getClientOriginalName();
        	$logoPath = 'images/logos/';

        	if(!file_exists($logoPath)) {
            Storage::disk('public')->makeDirectory($logoPath);     
        	}

        	$img = Image::make($logo->getRealPath());
        	$img->resize(300, null, function ($constraint) {
 				$constraint->aspectRatio();
			})->save($logoPath . $logoName);

        $logo = new Logo;
        $logo->logo = $logoName; 
        $logo->alt = $request->alt;
        $logo->save();

		  return ['name' => asset('/images/logos') . '/' . $logoName, 'img' => 'illustration'];
		} else {
		  return 'error';
		}
   }

   public function removeLogo(Request $request) {
		if($request->imageName) {
			$logo = Logo::where('logo', $request->imageName)->firstOrFail();
			$logoPath = 'images/logos/';
			$logoName = $logo->logo;

			Storage::disk('public')->delete($logoPath . $logoName);

			$logo->delete();

			return 'ok';
		} else {
			return 'failed';
		}
   }
}
