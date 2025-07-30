<?php

declare(strict_types=1);

namespace Tests\TirePressureMonitoring;

use RacingCar\TirePressureMonitoring\Alarm;
use RacingCar\TirePressureMonitoring\Sensor;

class FakeAlarm extends Alarm
{
    public function __construct(Sensor $sensor)
    {
        $this->sensor = $sensor;
    }
}
