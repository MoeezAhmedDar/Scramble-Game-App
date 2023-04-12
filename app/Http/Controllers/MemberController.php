<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Models\Game;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::paginate(10);

        return view('members.index', compact('members'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        $id = $member->id;
        $member = Member::where('id', $id)->first();

        $wins = Game::where(function ($query) use ($id) {
            $query->where('player1_id', $id)->where('player1_score', '>', DB::raw('player2_score'));
        })->orWhere(function ($query) use ($id) {
            $query->where('player2_id', $id)->where('player2_score', '>', DB::raw('player1_score'));
        })->count();

        $losses = Game::where(function ($query) use ($id) {
            $query->where('player1_id', $id)->where('player1_score', '<', DB::raw('player2_score'));
        })->orWhere(function ($query) use ($id) {
            $query->where('player2_id', $id)->where('player2_score', '<', DB::raw('player1_score'));
        })->count();

        $avg_score = Game::where('player1_id', $id)->orWhere('player2_id', $id)->avg(DB::raw('(CASE WHEN player1_id = ' . $id . ' THEN player1_score ELSE player2_score END)'));

        $highest_score = Game::join('members as m1', 'games.player1_id', '=', 'm1.id')
            ->join('members as m2', 'games.player2_id', '=', 'm2.id')
            ->select('games.*', DB::raw('CASE WHEN player1_id = ' . $id . ' THEN player1_score ELSE player2_score END as score'), 'm2.name as opponent_name')
            ->where(function ($query) use ($id) {
                $query->where('player1_id', $id)->orWhere('player2_id', $id);
            })->orderBy('score', 'desc')->first();
        $game = Game::where('player1_id', $id)->orWhere('player2_id', $id)->orderBy(DB::raw('CASE WHEN player1_id = ' . $id . ' THEN player1_score ELSE player2_score END'), 'DESC')->first();
        $highest_score = $game ? ($game->player1_id == $id ? $game->player1_score : $game->player2_score) : null;
        $highest_score_date = $game ? $game->game_date->format('Y-m-d') : null;
        $highest_score_opponent = $game ? ($game->player1_id == $id ? $game->player2->name : $game->player1->name) : null;

        return view('members.show', [
            'member' => $member,
            'wins' => $wins,
            'losses' => $losses,
            'avg_score' => $avg_score,
            'highest_score' => $highest_score,
            'highest_score_date' => $highest_score_date,
            'highest_score_opponent' => $highest_score_opponent,
        ]);
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(MemberRequest $request, Member $member)
    {
        try {
            $member->update([
                'name' => $request->name,
                'email' => $request->email,
                'contact_number' => $request->contact_number
            ]);
            $messages['success'] = "Member Updated Successfully";
            return redirect()
                ->route('dashboard')
                ->with('messages', $messages);
        } catch (\Exception $e) {
            $messages['danger'] = $e->getMessage();
            return redirect()
                ->back()
                ->with('messages', $messages);
        }
    }

    public function destroy(Member $member)
    {
        //
    }
}
