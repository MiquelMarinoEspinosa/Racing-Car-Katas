<?php

declare(strict_types=1);

namespace RacingCar\TurnTicketDispenser;

class TicketDispenser
{
    public function getTurnTicket(): TurnTicket
    {
        $newTurnNumber = $this->nextTurn();
        return new TurnTicket($newTurnNumber);
    }

    protected function nextTurn(): int
    {
        return TurnNumberSequence::nextTurn();
    }
}
