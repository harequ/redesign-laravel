<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Project;
use App\Illustration;
use App\Logo;
use App\ProjectImage;

class PagesController extends Controller
{

   public function index() {
   	$projects = Project::latest()->where('published', 1)->get();
   	$illustrations = Illustration::latest()->get();
   	$logos = Logo::latest()->get();

   	return view('front', compact('projects', 'illustrations', 'logos'));
   }

   public function project($slug) {
   	$project = Project::where('slug', $slug)->firstOrFail();
   	return view('projects/project', compact('project'));
   }

}
