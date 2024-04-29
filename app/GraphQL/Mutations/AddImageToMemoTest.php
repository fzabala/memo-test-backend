<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\MemoTest;
use App\Models\Image;
use Exception;

final readonly class AddImageToMemoTest
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $memoTest = MemoTest::find($args['id']);
        if (!$memoTest) {
            throw new Exception("MemoTest not found");
        }

        Image::create([
            'memo_test_id' => $memoTest->id,
            'url' => $args['image'],
        ]);

        return $memoTest->load('images');
    }
}
