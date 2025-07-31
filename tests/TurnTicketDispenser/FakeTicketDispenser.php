<?php

declare(strict_types=1);

namespace Tests\TurnTicketDispenser;

use RacingCar\TurnTicketDispenser\TicketDispenser;
use RacingCar\TurnTicketDispenser\TurnNumberSequence;
use RacingCar\TurnTicketDispenser\TurnNumberSequenceProxy;

class FakeTicketDispenser extends TicketDispenser
{
    public function __construct(protected ?TurnNumberSequenceProxy $turnNumberSequenceProxy)
    {
    }
}
