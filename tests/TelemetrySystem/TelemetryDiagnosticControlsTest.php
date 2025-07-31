<?php

declare(strict_types=1);

namespace Tests\TelemetrySystem;

use Exception;
use PHPUnit\Framework\TestCase;
use RacingCar\TelemetrySystem\TelemetryDiagnosticControls;

class TelemetryDiagnosticControlsTest extends TestCase
{
    public function testCheckTransmissionShouldSendAndReceiveDiagnosticMessage(): void
    {
        $this->expectException(Exception::class);
        $telemetryDiagnosticControls = new TelemetryDiagnosticControls();
        $telemetryDiagnosticControls->checkTransmission();
        //$this->assertSame('', $telemetryDiagnosticControls->diagnosticInfo);
    }
}
