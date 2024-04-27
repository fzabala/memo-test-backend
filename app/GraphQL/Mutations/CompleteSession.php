<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\GameSession;

final readonly class CompleteSession
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $sessionId = $args['id'];
        $gameSession = GameSession::find($sessionId);
        $memoTest = $gameSession->memoTest;

        $highestScore = $memoTest->highest_score;
        $gameSessionScore = $gameSession->score;

        if ($gameSessionScore > $highestScore) {
            $highestScore = $gameSessionScore;
        }
        $memoTest->update(["highest_score" => $highestScore]);

        GameSession::where('id', $sessionId)
            ->update(['state' => "COMPLETED"]);

        return GameSession::find($sessionId);
    }
}
