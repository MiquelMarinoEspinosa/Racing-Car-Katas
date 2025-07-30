<?php

declare(strict_types=1);

namespace Tests\TirePressureMonitoring;

use PHPUnit\Framework\TestCase;
use RacingCar\TirePressureMonitoring\Alarm;

class AlarmTest extends TestCase
{
    public function testShouldTheAlarmBeOffWhenTheAlarmIsCreated(): void
    {
        $alarm = new Alarm();
        $this->assertFalse($alarm->isAlarmOn());
    }

    public function testShouldAlarmBeOffWhenAlarmHasBeenChecked(): void
    {
        $alarm = new Alarm();
        $alarm->check();
        $this->assertFalse($alarm->isAlarmOn());
    }
}
