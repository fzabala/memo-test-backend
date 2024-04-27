<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameSession extends Model
{
    use HasFactory;

    protected $fillable = ["memo_test_id", "retries", "number_of_pairs", "state"];
    protected $appends = ['score'];

    public function getScoreAttribute()
    {
        if ($this->retries === 0) return 0;
        return floor($this->numberOfPairs / $this->retries * 100);
    }
}
