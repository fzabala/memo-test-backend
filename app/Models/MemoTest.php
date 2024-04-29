<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemoTest extends Model
{

    protected $fillable = ["name", "highest_score"];
    protected $appends = ['active_game_session'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function gameSessions()
    {
        return $this->hasMany(GameSession::class);
    }

    public function getActiveGameSessionAttribute()
    {
        return $this->gameSessions()->where('state', 'STARTED')->first();
    }
}
