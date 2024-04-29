<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\MemoTest;
use App\Models\CardGameSession;
use Exception;
use Illuminate\Support\Facades\DB;

final readonly class RemoveImageFromMemoTestById
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        return DB::transaction(function () use ($args) {
            $memoTest = MemoTest::find($args['id']);
            if (!$memoTest) {
                throw new Exception("MemoTest not found");
            }

            $imageToDestroy = $memoTest->images()->where('id', $args['imageId'])->first();
            if (!$imageToDestroy) {
                throw new Exception("Image not found");
            }

            CardGameSession::where('image_id', $imageToDestroy->id)->delete();
            $imageToDestroy->delete();

            return $memoTest->load('images');
        });
    }
}
