<?php

declare(strict_types=1);

namespace RacingCar\TurnTicketDispenser;

class TicketDispenser
{
    public function __construct(private ?TurnNumberSequenceProxy $turnNumberSequenceProxy = null)
    {
        $this->turnNumberSequenceProxy = $this->turnNumberSequenceProxy === null ? new TurnNumberSequenceProxy() : $this->turnNumberSequenceProxy;
    }

    public function getTurnTicket(): TurnTicket
    {
        $newTurnNumber = $this->turnNumberSequenceProxy->nextTurn();
        return new TurnTicket($newTurnNumber);
    }
}
