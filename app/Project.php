<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $fillable = [
	'title',
	'slug',
	'excerpt',
	'body',
	'thumbnail',
	'link',
	'href',
	'published'
	];

	/**
	 * Get the projectRoles associated with the given project.
	 * @return [type] [description]
	 */
	public function projectRoles() {
		return $this->belongsToMany('App\ProjectRole', 'pivot_project_role_project', 'project_id', 'project_role_id')->withTimestamps();
	}

	/**
	 * Get a list of projectRoles ids associated with the current project.
	 * @return array
	 */
	public function getListAttribute() {
		return $this->projectRoles->lists('id')->all();
	}
}
