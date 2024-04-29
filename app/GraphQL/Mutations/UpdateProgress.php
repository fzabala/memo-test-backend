<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\CardGameSession;
use App\Models\GameSession;

final readonly class UpdateProgress
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $id = $args['id'];
        $flipped = $args['flipped'];
        $selected = $args['selected'];
        $cardGameSession = CardGameSession::find($id);
        $flippedCardGameSession = CardGameSession::where('game_session_id', $cardGameSession->game_session_id)
            ->where('flipped', true)
            ->where('selected', true)
            ->first();
        if (!$flippedCardGameSession) {
            $cardGameSession->update(['flipped' => $flipped, "selected" => $selected]);
        } else {
            // save progress
            $isMatch = $cardGameSession->image_id === $flippedCardGameSession->image_id;
            $cardGameSession->update(['flipped' => $isMatch, "selected" => false]);
            $flippedCardGameSession->update(['flipped' => $isMatch, "selected" => false]);

            // save retries
            GameSession::where('id', $cardGameSession->game_session_id)
                ->increment('retries', 1);
        }
        return CardGameSession::find($id)->gameSession->load('cardsGameSession');
    }
}
