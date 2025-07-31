<?php

declare(strict_types=1);

namespace RacingCar\TurnTicketDispenser;

class TicketDispenser
{
    private TurnNumberSequenceProxy $turnNumberSequenceProxy;

    public function __construct()
    {
        $this->turnNumberSequenceProxy = new TurnNumberSequenceProxy();
    }

    public function getTurnTicket(): TurnTicket
    {
        $newTurnNumber = $this->nextTurn();
        return new TurnTicket($newTurnNumber);
    }

    protected function nextTurn(): int
    {
        return $this->turnNumberSequenceProxy->nextTurn();
    }
}
