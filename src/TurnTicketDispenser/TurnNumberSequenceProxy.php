<?php

declare(strict_types=1);

namespace RacingCar\TurnTicketDispenser;

class TurnNumberSequenceProxy
{
    public function nextTurn(): int
    {
        return TurnNumberSequence::nextTurn();
    }
}
