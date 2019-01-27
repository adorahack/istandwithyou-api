<?php
/**
 * Created by PhpStorm.
 * User: bellanaijadev
 * Date: 2019-01-27
 * Time: 12:24
 */

namespace App\Http\Services;

use App\Candidate;
use App\Http\Contracts\CandidateContract;
use Illuminate\Support\Facades\Cache;

class Candidates implements CandidateContract{

	private $candidate;

	/**
	 * Candidates constructor.
	 * @param Candidate $candidate
	 */
	public function __construct(Candidate $candidate)
	{
		$this->candidate = $candidate;
	}


	/**
	 * @return Candidate[]|\Illuminate\Database\Eloquent\Collection
	 */
	public function all()
	{
		return Cache::rememberForever('candidates', function () {
			return $this->candidate->with('votes')->get();
		});
	}

	/**
	 * @param $id
	 * @return Candidate
	 */
	public function show($id)
	{
		return Cache::rememberForever('candidate-'.$id, function ($id) {
			return $this->candidate->with('votes')->find($id);
		});
	}

	/**
	 * @param $id
	 * @param $data
	 * @return Candidate
	 */
	public function update($id, $data)
	{
		$candidate = $this->candidate->with('votes')->where('id', $id)->first();

		if(!$candidate){
			return null;
		}

		$candidate->name = $data['name'];
		$candidate->party = $data['party'];

		$candidate->save();

		Cache::forget('candidate-'.$id);
		Cache::forget('candidates');
		Cache::forever('candidate-'.$id, $candidate);

		return $candidate;
	}

	/**
	 * @param $id
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function votes($id)
	{
		return $this->candidate->votes()->where('id', $id);
	}

	/**
	 * @param $data
	 * @return Candidate
	 */
	public function create($data)
	{
		$this->candidate->name = $data['name'];
		$this->candidate->party = $data['party'];

		$this->candidate->save();

		Cache::forget('candidates');
		Cache::forever('candidate-'.$this->candidate->id, $this->candidate);

		return $this->candidate;
	}

	/**
	 * @param $id
	 * @return bool
	 */
	public function delete($id)
	{
		$this->candidate->destroy($id);

		Cache::forget('candidates');
		Cache::forget('candidate-'.$id);

		return true;

	}
}