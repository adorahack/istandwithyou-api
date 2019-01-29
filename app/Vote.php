<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'candidate_id', 'name', 'reason', 'anonymous',
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	public function candidate(){
		return $this->belongsTo('App\Candidate');
	}

}