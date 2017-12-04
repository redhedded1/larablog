<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	/**
	 * fillable fields for a tag
	 * @var array
	 */
	protected $fillable = [
		'name'
	];
	/**
	 * many to many relationship with articles
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function articles(){
		return $this->belongsToMany( 'App\Article' )->withTimestamps();
	}
}
