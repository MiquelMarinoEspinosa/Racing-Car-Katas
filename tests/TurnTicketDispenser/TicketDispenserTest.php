<?php

declare(strict_types=1);

namespace Tests\TurnTicketDispenser;

use PHPUnit\Framework\TestCase;
use RacingCar\TurnTicketDispenser\TicketDispenser;
use RacingCar\TurnTicketDispenser\TurnNumberSequence;
use ReflectionClass;

class TicketDispenserTest extends TestCase
{
    public function testIntegrationShouldReturnZeroAsTurnNumber(): void
    {
        $dispenser = new TicketDispenser();
        $ticket = $dispenser->getTurnTicket();
        $this->assertSame(0, $ticket->getTurnNumber());
    }

    public function testIntegrationReflectionShouldReturnZeroAsTurnNumber(): void
    {
        $reflectedTurnNumberSequence = new ReflectionClass(TurnNumberSequence::class);
        $reflectedfTurnNumber = $reflectedTurnNumberSequence->getProperty('turnNumber');
        $previousTurnNumberValue = $reflectedfTurnNumber->getValue();
        $reflectedfTurnNumber->setValue(null, 45);

        $dispenser = new TicketDispenser();
        $ticket = $dispenser->getTurnTicket();

        $this->assertSame(45, $ticket->getTurnNumber());

        $reflectedfTurnNumber->setValue(null, $previousTurnNumberValue);
    }

    public function testIntegrationSetterShouldReturnZeroAsTurnNumber(): void
    {
        $dispenser = new TicketDispenser();
        $previousTurnNumber = TurnNumberSequence::getTurnNumber();
        $expectedNumber = 67;
        TurnNumberSequence::setTurnNumber($expectedNumber);

        $ticket = $dispenser->getTurnTicket();
        $this->assertSame($expectedNumber, $ticket->getTurnNumber());

        TurnNumberSequence::setTurnNumber($previousTurnNumber);
    }

    public function testUnitPartialMockShouldReturnZeroAsTurnNumber(): void
    {
        $partialMockTicketDispenser = $this->getMockBuilder(TicketDispenser::class)
            ->onlyMethods(['nextTurn'])
            ->getMock();

        $expectedNumber = 70;
        $partialMockTicketDispenser
            ->method('nextTurn')
            ->willReturn($expectedNumber);

        $ticket = $partialMockTicketDispenser->getTurnTicket();
        $this->assertSame($expectedNumber, $ticket->getTurnNumber());
    }

    public function testUnitFakeClassShouldReturnZeroAsTurnNumber(): void
    {
        $expectedTurnNumber = 82;
        $fakeDispenser = new FakeTicketDispenser($expectedTurnNumber);

        $ticket = $fakeDispenser->getTurnTicket();
        $this->assertSame($expectedTurnNumber, $ticket->getTurnNumber());
    }
}
