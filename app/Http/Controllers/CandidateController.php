<?php

namespace App\Http\Controllers;

use App\Http\Contracts\CandidateContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CandidateController extends Controller
{

	private $candidate;

	/**
	 * Create a new controller instance.
	 *
	 * @param CandidateContract $candidate
	 */
	public function __construct(CandidateContract $candidate)
	{
		$this->candidate = $candidate;
	}

	/**
	 * Return all candidates with votes
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function all()
	{
		return response()->json($this->candidate->all(), 200);
	}

	/**
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show($id)
	{
		return response()->json($this->candidate->show($id), 200);
	}

	/**
	 * Get votes for a candidate
	 *
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function votes($id)
	{
		return response()->json($this->candidate->votes($id), 200);
	}

	/**
	 * Update existing candidate
	 *
	 * @param $id
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update($id, Request $request)
	{
		$data = $request->only(['name', 'party']);
		$validate = $this->validator($data);

		if($validate->fails()) {
			return response()->json($validate->errors(), 400);
		}

		return response()->json($this->candidate->update($id, $data), 200);
	}

	/**
	 * Create a new candidate
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function create(Request $request)
	{
		$data = $request->only(['name', 'party']);
		$validate = $this->validator($data);

		if($validate->fails()) {
			return response()->json($validate->errors(), 400);
		}

		return response()->json($this->candidate->create($data), 200);
	}

	/**
	 * Delete candidate
	 *
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function delete($id)
	{
		return response()->json($this->candidate->delete($id), 200);
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
			'name' => 'required',
			'party' => 'required',
		], [
			'name.required' => 'The candidate\'s name is required',
			'party.required' => 'The candidate\'s party is required',
		]);
	}
}
