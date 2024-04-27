<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ["url"];

    public function memoTest()
    {
        return $this->belongsTo(MemoTest::class);
    }

    public function getUrlAttribute($value)
    {
        if (strpos($value, 'http://') === 0 || strpos($value, 'https://') === 0) {
            return $value;
        }

        return asset($value);
    }
}
