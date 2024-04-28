<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardGameSession extends Model
{
    use HasFactory;

    protected $fillable = ["game_session_id", "flipped", "selected", "image_id"];

    public function gameSession()
    {
        return $this->belongsTo(GameSession::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
