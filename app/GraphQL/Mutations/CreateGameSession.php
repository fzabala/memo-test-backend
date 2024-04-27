<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\GameSession;

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

        return GameSession::create([
            "memo_test_id" => $gameId,
            "retries" => 0,
            "number_of_pairs" => 0,
            "state" => "STARTED"
        ]);
    }
}
