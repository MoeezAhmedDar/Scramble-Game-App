<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $casts = ['game_date' => 'datetime'];

    public function player2()
    {
        return $this->belongsTo(Member::class, 'player2_id');
    }

    public function player1()
    {
        return $this->belongsTo(Member::class, 'player1_id');
    }
}
