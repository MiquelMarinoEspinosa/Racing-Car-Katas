<?php

declare(strict_types=1);

namespace Tests\TurnTicketDispenser;

use RacingCar\TurnTicketDispenser\TicketDispenser;

class FakeTicketDispenser extends TicketDispenser
{
    public function __construct(private int $turnNumber)
    {
    }

    protected function nextTurn(): int
    {
        return $this->turnNumber;
    }
}
