<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'party',
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	public function votes(){
		return $this->hasMany('App\Vote');
	}

}