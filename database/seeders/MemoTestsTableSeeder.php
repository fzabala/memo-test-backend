<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MemoTest;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

class MemoTestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Image::truncate();
        MemoTest::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $memoTest1 = MemoTest::create([
            'name' => "First memo",
            'highest_score' => 0,
        ]);

        Image::create([
            'url' => "storage/img/mario.png",
            'memo_test_id' => $memoTest1->id,
        ]);

        Image::create([
            'url' => "storage/img/peach.png",
            'memo_test_id' => $memoTest1->id,
        ]);

        $memoTest2 = MemoTest::create([
            'name' => "Last memo",
            'highest_score' => 0,
        ]);

        Image::create([
            'url' => "storage/img/bowser.png",
            'memo_test_id' => $memoTest2->id,
        ]);

        Image::create([
            'url' => "storage/img/toad.png",
            'memo_test_id' => $memoTest2->id,
        ]);
    }
}
