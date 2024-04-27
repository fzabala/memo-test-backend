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
        GameSession::where('id', $sessionId)
            ->update(['state' => "COMPLETED"]);

        return GameSession::find($sessionId);
    }
}
