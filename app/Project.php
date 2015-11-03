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
}
