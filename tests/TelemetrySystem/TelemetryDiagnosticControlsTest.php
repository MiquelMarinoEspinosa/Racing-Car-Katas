<?php

declare(strict_types=1);

namespace Tests\TelemetrySystem;

use Exception;
use PHPUnit\Framework\TestCase;
use RacingCar\TelemetrySystem\TelemetryClient;
use RacingCar\TelemetrySystem\TelemetryDiagnosticControls;

class TelemetryDiagnosticControlsTest extends TestCase
{
    public function testCheckTransmissionShouldFailedWhenClientCannotConnect(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Unable to connect.');
        $mockedTelemetryClient = $this->createMock(TelemetryClient::class);
        $mockedTelemetryClient
            ->method('getOnlineStatus')
            ->willReturn(false);

        $fakeTelemetryDiagnosticControls = new FakeTelemetryDiagnosticControls(
            $mockedTelemetryClient
        );
        $fakeTelemetryDiagnosticControls->checkTransmission();
    }
}
