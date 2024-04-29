<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Image;
use App\Models\MemoTest;
use Exception;

final readonly class RemoveImageFromMemoTestById
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $memoTest = MemoTest::find($args['id']);
        if (!$memoTest) {
            throw new Exception("MemoTest not found");
        }

        $imageToDestroy = $memoTest->images()->where('id', $args['imageId'])->first();
        if (!$imageToDestroy) {
            throw new Exception("Image not found");
        }

        $imageToDestroy->delete();

        return $memoTest->load('images');
    }
}
