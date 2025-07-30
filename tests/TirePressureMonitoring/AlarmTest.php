<?php

declare(strict_types=1);

namespace Tests\TirePressureMonitoring;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\MockObject\MockObject;
use RacingCar\TirePressureMonitoring\Alarm;
use RacingCar\TirePressureMonitoring\Sensor;

class AlarmTest extends TestCase
{
    private const float MIN_PRESSURE = 17.0;
    private const float MAX_PRESSURE = 21.0;

    private Sensor | MockObject $mockSensor;
    private Alarm $alarm;

    protected function setUp(): void
    {
        $this->mockSensor = $this->createMock(Sensor::class);
        $this->alarm = new Alarm($this->mockSensor);
    }

    public function testShouldTheAlarmBeOffWhenTheAlarmIsCreated(): void
    {
        $this->assertFalse($this->alarm->isAlarmOn());
    }

    #[DataProvider('normalPressureProvider')]
    public function testShouldAlarmBeOffWhenItHasBeenCheckedWithNormalPressure(
        float $normalPressure
    ): void {
        $this->mockSensor
            ->method('popNextPressurePsiValue')
            ->willReturn($normalPressure);

        $this->alarm->check();
        $this->assertFalse($this->alarm->isAlarmOn());
    }

    #[DataProvider('notNormalPressureProvider')]
    public function testShouldAlarmBeOnWhenItHasBeenCheckedWithNotNormalPressure(
        float $notNormalPressure
    ): void {
        $this->mockSensor
            ->method('popNextPressurePsiValue')
            ->willReturn($notNormalPressure);

        $this->alarm->check();
        $this->assertTrue($this->alarm->isAlarmOn());
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
