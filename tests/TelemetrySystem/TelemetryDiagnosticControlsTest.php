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
            ->expects($this->exactly(5))
            ->method('getOnlineStatus')
            ->willReturn(false);

        $fakeTelemetryDiagnosticControls = new FakeTelemetryDiagnosticControls(
            $mockedTelemetryClient
        );
        $fakeTelemetryDiagnosticControls->checkTransmission();
    }

    public function testCheckTransmissionShouldSuccedAndReturnDiagnosticInfo(): void
    {
        $expectedDiagnosticInfo = 'OK!';
        $mockedTelemetryClient = $this->createMock(TelemetryClient::class);
        $mockedTelemetryClient
            ->method('getOnlineStatus')
            ->willReturnOnConsecutiveCalls(false, true, true);

        $mockedTelemetryClient
            ->method('receive')
            ->willReturn($expectedDiagnosticInfo);

        $fakeTelemetryDiagnosticControls = new FakeTelemetryDiagnosticControls(
            $mockedTelemetryClient
        );
        $fakeTelemetryDiagnosticControls->checkTransmission();

        $this->assertSame(
            $expectedDiagnosticInfo,
            $fakeTelemetryDiagnosticControls->diagnosticInfo
        );
    }
}
