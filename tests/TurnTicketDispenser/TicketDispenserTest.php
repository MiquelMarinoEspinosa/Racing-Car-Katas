<?php

declare(strict_types=1);

namespace Tests\TurnTicketDispenser;

use PHPUnit\Framework\TestCase;
use RacingCar\TurnTicketDispenser\TicketDispenser;
use RacingCar\TurnTicketDispenser\TurnNumberSequence;
use RacingCar\TurnTicketDispenser\TurnNumberSequenceProxy;
use ReflectionClass;

class TicketDispenserTest extends TestCase
{
    public function testIntegrationShouldReturnZeroAsTurnNumber(): void
    {
        $dispenser = new TicketDispenser(
            new TurnNumberSequenceProxy()
        );
        $ticket = $dispenser->getTurnTicket();
        $this->assertSame(0, $ticket->getTurnNumber());
    }

    public function testIntegrationReflectionShouldReturnZeroAsTurnNumber(): void
    {
        $reflectedTurnNumberSequence = new ReflectionClass(TurnNumberSequence::class);
        $reflectedfTurnNumber = $reflectedTurnNumberSequence->getProperty('turnNumber');
        $previousTurnNumberValue = $reflectedfTurnNumber->getValue();
        $reflectedfTurnNumber->setValue(null, 45);

        $dispenser = new TicketDispenser(
            new TurnNumberSequenceProxy()
        );
        $ticket = $dispenser->getTurnTicket();

        $this->assertSame(45, $ticket->getTurnNumber());

        $reflectedfTurnNumber->setValue(null, $previousTurnNumberValue);
    }

    public function testIntegrationSetterShouldReturnZeroAsTurnNumber(): void
    {
        $dispenser = new TicketDispenser(
            new TurnNumberSequenceProxy()
        );
        $previousTurnNumber = TurnNumberSequence::getTurnNumber();
        $expectedNumber = 67;
        TurnNumberSequence::setTurnNumber($expectedNumber);

        $ticket = $dispenser->getTurnTicket();
        $this->assertSame($expectedNumber, $ticket->getTurnNumber());

        TurnNumberSequence::setTurnNumber($previousTurnNumber);
    }

    public function testUnitFakeClassShouldReturnZeroAsTurnNumber(): void
    {
        $expectedTurnNumber = 82;
        $mockTurnNumberSequenceProxy = $this->createMock(
            TurnNumberSequenceProxy::class
        );
        $mockTurnNumberSequenceProxy->method('nextTurn')
            ->willReturn($expectedTurnNumber);

        $fakeDispenser = new FakeTicketDispenser($mockTurnNumberSequenceProxy);

        $ticket = $fakeDispenser->getTurnTicket();
        $this->assertSame($expectedTurnNumber, $ticket->getTurnNumber());
    }
}
