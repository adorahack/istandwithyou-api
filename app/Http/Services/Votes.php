<?php
/**
 * Created by PhpStorm.
 * User: bellanaijadev
 * Date: 2019-01-27
 * Time: 12:24
 */

namespace App\Http\Services;

use App\Vote;
use App\Http\Contracts\VoteContract;
use Illuminate\Support\Facades\Cache;

class Votes implements VoteContract{

	private $vote;

	/**
	 * Votes constructor.
	 * @param Vote $vote
	 */
	public function __construct(Vote $vote)
	{
		$this->vote = $vote;
	}

	/**
	 * @return Vote|Vote[]|\Illuminate\Database\Eloquent\Collection
	 */
	public function all()
	{
		return Cache::rememberForever('votes', function () {
			return $this->vote->with('candidate')->get();
		});
	}

	/**
	 * @param $id
	 * @return Vote
	 */
	public function show($id)
	{
		return Cache::rememberForever('vote-'.$id, function () use ($id) {
			return $this->vote->with('candidates')->find($id);
		});
	}

	/**
	 * @param $data
	 * @return Vote
	 */
	public function create($data)
	{
		$this->vote->candidate_id = $data['candidate_id'];
		$this->vote->name = $data['name'];
		$this->vote->reason = $data['reason'];
		$this->vote->anonymous = $data['anonymous'];

		$this->vote->save();

		Cache::forget('votes');
		Cache::forever('vote-'.$this->vote->id, $this->vote);

		return $this->vote;

	}
}