<?php

declare(strict_types=1);

namespace RacingCar\TurnTicketDispenser;

class TicketDispenser
{
    public function __construct(private TurnNumberSequenceProxy $turnNumberSequenceProxy)
    {
    }

    public function getTurnTicket(): TurnTicket
    {
        $newTurnNumber = $this->turnNumberSequenceProxy->nextTurn();
        return new TurnTicket($newTurnNumber);
    }
}
