<?php

declare(strict_types=1);

namespace Tests\TirePressureMonitoring;

use PHPUnit\Framework\TestCase;
use RacingCar\TirePressureMonitoring\Alarm;
use RacingCar\TirePressureMonitoring\Sensor;

class AlarmTest extends TestCase
{
    public function testShouldTheAlarmBeOffWhenTheAlarmIsCreated(): void
    {
        $alarm = new Alarm();
        $this->assertFalse($alarm->isAlarmOn());
    }

    public function testShouldAlarmBeOffWhenAlarmHasBeenCheckedWithNormalLowPressureValue(): void
    {
        $mockSensor = $this->createMock(Sensor::class);
        $mockSensor
            ->method('popNextPressurePsiValue')
            ->willReturn(17.0);

        $alarm = new FakeAlarm($mockSensor);
        $alarm->check();
        $this->assertFalse($alarm->isAlarmOn());
    }
}
