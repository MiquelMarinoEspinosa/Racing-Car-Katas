<?php

declare(strict_types=1);

namespace Tests\TurnTicketDispenser;

use PHPUnit\Framework\TestCase;
use RacingCar\TurnTicketDispenser\TicketDispenser;
use RacingCar\TurnTicketDispenser\TurnNumberSequence;
use ReflectionClass;

class TicketDispenserTest extends TestCase
{
    public function testShouldReturnZeroAsTurnNumber(): void
    {
        $dispenser = new TicketDispenser();
        $ticket = $dispenser->getTurnTicket();
        $this->assertSame(0, $ticket->getTurnNumber());
    }

    public function testReflectionShouldReturnZeroAsTurnNumber(): void
    {
        $reflectedTurnNumberSequence = new ReflectionClass(TurnNumberSequence::class);
        $reflectedfTurnNumber = $reflectedTurnNumberSequence->getProperty('turnNumber');
        $oldTurnNumberValue = $reflectedfTurnNumber->getValue();
        $reflectedfTurnNumber->setValue(45);

        $dispenser = new TicketDispenser();
        $ticket = $dispenser->getTurnTicket();

        $this->assertSame(45, $ticket->getTurnNumber());

        $reflectedfTurnNumber->setValue($oldTurnNumberValue);
    }
}
