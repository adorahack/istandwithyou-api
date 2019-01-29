<?php
/**
 * Created by PhpStorm.
 * User: bellanaijadev
 * Date: 2019-01-27
 * Time: 12:24
 */

namespace App\Http\Contracts;

use App\Candidate;
use App\Vote;

interface CandidateContract
{

	/**
	 * @return Candidate
	 */
	public function all();

	/**
	 * @param $id
	 * @return Candidate
	 */
	public function show($id);

	/**
	 * @param $id
	 * @param $data
	 * @return Candidate
	 */
	public function update($id, $data);

	/**
	 * @param $id
	 * @return Vote
	 */
	public function votes($id);

	/**
	 * @param $data
	 * @return Candidate
	 */
	public function create($data);

	/**
	 * @param $id
	 * @return boolean
	 */
	public function delete($id);
}