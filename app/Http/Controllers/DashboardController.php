<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Project;
use App\Illustration;
use App\Logo;

class DashboardController extends Controller
{
	public function showDashboard() {
		$projects = new Project;
		$projectCount = $projects->count();
		$published = $projects->where('published', 1)->count();
      $unpublished = $projects->where('published', 0)->count();
      $illustrations = Illustration::count();
      $logos = Logo::count();
		return view('dashboard/dashboard', compact('projectCount', 'published', 'unpublished', 'illustrations', 'logos'));	
	}   
}
