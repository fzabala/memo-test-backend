<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\CardGameSession;
use App\Models\GameSession;
use App\Models\MemoTest;
use App\Models\Image;
use Exception;

final readonly class DeleteMemoTestById
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $imageIds = Image::where('memo_test_id', $args['id'])->select('id');
        CardGameSession::whereIn('image_id', $imageIds)->delete();
        Image::where('memo_test_id', $args['id'])->delete();
        GameSession::where('memo_test_id', $args['id'])->delete();
        MemoTest::where('id', $args['id'])->delete();
        return true;
    }
}
