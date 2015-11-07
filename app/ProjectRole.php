<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectRole extends Model
{
	protected $fillable = [
	'name'
	];

	/**
	 * Get the projects associated with the given projectRole
	 * @return [type] [description]
	 */
	public function projects() {
		return $this->belongsToMany('App\Project', 'pivot_project_role_project', 'project_role_id', 'project_id')->withTimestamps();
	}
}
