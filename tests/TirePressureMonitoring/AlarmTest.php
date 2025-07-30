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
        $alarm = new Alarm($this->createMock(Sensor::class));
        $this->assertFalse($alarm->isAlarmOn());
    }

    #[DataProvider('normalPressureProvider')]
    public function testShouldAlarmBeOffWhenItHasBeenCheckedWithNormalPressure(
        float $normalPressure
    ): void {
        $mockSensor = $this->createMock(Sensor::class);
        $mockSensor
            ->method('popNextPressurePsiValue')
            ->willReturn($normalPressure);

        $alarm = new Alarm($mockSensor);
        $alarm->check();
        $this->assertFalse($alarm->isAlarmOn());
    }

    #[DataProvider('notNormalPressureProvider')]
    public function testShouldAlarmBeOnWhenItHasBeenCheckedWithNotNormalPressure(
        float $notNormalPressure
    ): void {
        $mockSensor = $this->createMock(Sensor::class);
        $mockSensor
            ->method('popNextPressurePsiValue')
            ->willReturn($notNormalPressure);

        $alarm = new Alarm($mockSensor);
        $alarm->check();
        $this->assertTrue($alarm->isAlarmOn());
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

    /**
     * @return array<float>
     */
    public static function notNormalPressureProvider(): array
    {
        return [
            'min pressure not allowed value' => [self::MIN_PRESSURE - 0.01],
            'max pressure not allowed value' => [self::MAX_PRESSURE + 0.01]
        ];
    }
}
