<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\CardGameSession;
use App\Models\GameSession;
use App\Models\MemoTest;

final readonly class CreateGameSession
{
    public function __invoke(null $_, array $args)
    {
        $gameId = $args['gameId'];
        $gameSession = GameSession::where('memo_test_id', $gameId)
            ->where('state', "STARTED")
            ->first();

        if ($gameSession) {
            return $gameSession;
        }

        $memoTest = MemoTest::find($gameId);
        $numberOfPairs = $memoTest->images->count();

        $gameSession = GameSession::create([
            "memo_test_id" => $gameId,
            "retries" => 0,
            "number_of_pairs" => $numberOfPairs,
            "state" => "STARTED"
        ]);

        $gameCards = [];
        foreach ($memoTest->images as $image) {
            $gameCards[] = [
                "game_session_id" => $gameSession->id,
                "flipped" => false,
                "selected" => false,
                "image_id" => $image->id
            ];
            $gameCards[] = [
                "game_session_id" => $gameSession->id,
                "flipped" => false,
                "selected" => false,
                "image_id" => $image->id
            ];
        }

        shuffle($gameCards);
        foreach ($gameCards as $gameCard) {
            CardGameSession::create($gameCard);
        }

        return $gameSession->load('cardsGameSession');
    }
}
