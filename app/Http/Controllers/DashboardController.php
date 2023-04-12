<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $topMembers = DB::table('members')->join('games', function ($join) {
            $join->on('members.id', '=', 'games.player1_id')
                ->orWhere('members.id', '=', 'games.player2_id');
        })
            ->select('members.id', 'members.name', DB::raw('SUM(CASE WHEN games.player1_id = members.id THEN player1_score ELSE player2_score END) as total_score'), DB::raw('count(*) as games_played'))
            ->groupBy('members.id')
            ->havingRaw('COUNT(*) >= 10')
            ->orderByRaw('SUM(CASE WHEN games.player1_id = members.id THEN player1_score ELSE player2_score END) / COUNT(*) DESC')
            ->limit(10)
            ->get();

        return view('dashboard', compact('topMembers'));
    }
}
