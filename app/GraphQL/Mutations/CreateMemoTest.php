<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Image;
use App\Models\MemoTest;
use Exception;

final readonly class CreateMemoTest
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $memoTest = MemoTest::create([
            'name' => $args['name'],
            'highest_score' => 0
        ]);

        foreach ($args['images'] as $image) {
            Image::create([
                'memo_test_id' => $memoTest->id,
                'url' => $image,
            ]);
        }

        return $memoTest->load("images");
    }
}
