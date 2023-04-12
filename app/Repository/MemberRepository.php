<?php

namespace App\Repository;

use App\Interfaces\MemberRepositoryInterface;
use App\Models\Game;
use App\Models\Member;
use Illuminate\Support\Facades\DB;

class MemberRepository implements MemberRepositoryInterface
{
    public function getMemberDetail($member)
    {
        $id = $member->id;
        $member = Member::where('id', $id)->first();

        $member_detail['wins'] = $this->wins($id);

        $member_detail['losses'] = $this->losses($id);

        $member_detail['avg_score'] = $this->averageScore($id);

        $member_detail['highest_score'] = $this->highestScore($id);

        $member_detail['game'] = $this->game($id);

        $member_detail['highest_score'] = $member_detail['game'] ? ($member_detail['game']->player1_id == $id ? $member_detail['game']->player1_score : $member_detail['game']->player2_score) : null;
        $member_detail['highest_score_date'] = $member_detail['game'] ? $member_detail['game']->game_date->format('Y-m-d') : null;
        $member_detail['highest_score_opponent'] = $member_detail['game'] ? ($member_detail['game']->player1_id == $id ? $member_detail['game']->player2->name : $member_detail['game']->player1->name) : null;

        return $member_detail;
    }

    private function wins($id)
    {
        $wins
            = Game::where(function ($query) use ($id) {
                $query->where('player1_id', $id)->where('player1_score', '>', DB::raw('player2_score'));
            })->orWhere(function ($query) use ($id) {
                $query->where('player2_id', $id)->where('player2_score', '>', DB::raw('player1_score'));
            })->count();

        return $wins;
    }

    private function losses($id)
    {
        $losses = Game::where(function ($query) use ($id) {
            $query->where('player1_id', $id)->where('player1_score', '<', DB::raw('player2_score'));
        })->orWhere(function ($query) use ($id) {
            $query->where('player2_id', $id)->where('player2_score', '<', DB::raw('player1_score'));
        })->count();

        return $losses;
    }

    private function averageScore($id)
    {
        $avg_score
            = Game::where('player1_id', $id)->orWhere('player2_id', $id)->avg(DB::raw('(CASE WHEN player1_id = ' . $id . ' THEN player1_score ELSE player2_score END)'));

        return $avg_score;
    }

    private function highestScore($id)
    {
        $highest_score = Game::join('members as m1', 'games.player1_id', '=', 'm1.id')
            ->join('members as m2', 'games.player2_id', '=', 'm2.id')
            ->select('games.*', DB::raw('CASE WHEN player1_id = ' . $id . ' THEN player1_score ELSE player2_score END as score'), 'm2.name as opponent_name')
            ->where(function ($query) use ($id) {
                $query->where('player1_id', $id)->orWhere('player2_id', $id);
            })->orderBy('score', 'desc')->first();

        return $highest_score;
    }

    private function game($id)
    {
        $game = Game::where('player1_id', $id)->orWhere('player2_id', $id)->orderBy(DB::raw('CASE WHEN player1_id = ' . $id . ' THEN player1_score ELSE player2_score END'), 'DESC')->first();

        return $game;
    }
}
