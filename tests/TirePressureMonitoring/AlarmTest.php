<?php

declare(strict_types=1);

namespace Tests\TirePressureMonitoring;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use RacingCar\TirePressureMonitoring\Alarm;
use RacingCar\TirePressureMonitoring\Sensor;

class AlarmTest extends TestCase
{
    private const float MIN_PRESSURE = 17.0;
    private const float MAX_PRESSURE = 21.0;

    public function testShouldTheAlarmBeOffWhenTheAlarmIsCreated(): void
    {
        $alarm = new Alarm();
        $this->assertFalse($alarm->isAlarmOn());
    }

    #[DataProvider('normalPressureProvider')]
    public function testShouldAlarmBeOffWhenAlarmHasBeenCheckedWithNormalPressure(
        float $normalPressure
    ): void
    {
        $mockSensor = $this->createMock(Sensor::class);
        $mockSensor
            ->method('popNextPressurePsiValue')
            ->willReturn($normalPressure);

        $alarm = new FakeAlarm($mockSensor);
        $alarm->check();
        $this->assertFalse($alarm->isAlarmOn());
    }

    #[DataProvider('normalPressureProvider')]
    public function testShouldAlarmBeOffWhenAlarmHasBeenCheckedWithNormalPressureUsingSetter(
        float $normalPressure
    ): void
    {
        $mockSensor = $this->createMock(Sensor::class);
        $mockSensor
            ->method('popNextPressurePsiValue')
            ->willReturn($normalPressure);

        $alarm = new Alarm();
        $alarm->setSensor($mockSensor);
        $alarm->check();
        $this->assertFalse($alarm->isAlarmOn());
    }

    /**
     * @return array<float>
     */
    public static function normalPressureProvider(): array
    {
        return [
            'min pressure allowed value' => [self::MIN_PRESSURE],
            'max pressure allowed value' => [self::MAX_PRESSURE]
        ];
    }
}
