<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemoTest extends Model
{

    protected $fillable = ["name", "highest_score"];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
