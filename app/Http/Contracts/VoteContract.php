<?php
/**
 * Created by PhpStorm.
 * User: bellanaijadev
 * Date: 2019-01-27
 * Time: 12:24
 */

namespace App\Http\Contracts;

use App\Vote;

interface VoteContract
{

	/**
	 * @return Vote
	 */
	public function all();

	/**
	 * @param $id
	 * @return Vote
	 */
	public function show($id);

	/**
	 * @param $data
	 * @return Vote
	 */
	public function create($data);
}