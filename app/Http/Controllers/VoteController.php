<?php

namespace App\Http\Controllers;

use App\Http\Contracts\VoteContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VoteController extends Controller
{

	private $vote;

	/**
	 * Create a new controller instance.
	 *
	 * @param VoteContract $vote
	 */
	public function __construct(VoteContract $vote)
	{
		$this->vote = $vote;
	}

	/**
	 * Return all votes
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function all()
	{
		return response()->json($this->vote->all(), 200);
	}

	/**
	 * Return a vote
	 *
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show($id)
	{
		return response()->json($this->vote->show($id), 200);
	}

	/**
	 * Save a vote
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function create(Request $request)
	{
		$data = $request->only(['candidate_id', 'name', 'reason', 'anonymous']);
		$validate = $this->validator($data);

		if($validate->fails()) {
			return response()->json($validate->errors(), 400);
		}

		return response()->json($this->vote->create($data), 200);
	}

	/**
	 * Delete candidate
	 *
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function delete($id)
	{
		return response()->json($this->vote->delete($id), 200);
	}

	/**
	 * Validate request input
	 *
	 * @param array $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'candidate_id' => 'required|exists:candidates,id',
			'name' => 'required',
			'reason' => 'required',
			'anonymous' => 'required|boolean'
		], [
			'candidate_id.required' => 'The candidate is required',
			'candidate_id.exists' => 'The candidate does not exist',
			'name.required' => 'Ensure your first name is filled',
			'reason.required' => 'Why are you voting for this candidate?',
			'anonymous.required' => 'Anonymity option is required',
			'anonymous.boolean' => 'Invalid option for anonymity'
		]);
	}
}
