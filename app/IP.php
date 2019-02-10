<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IP extends Model{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'ip',
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'ips';

}