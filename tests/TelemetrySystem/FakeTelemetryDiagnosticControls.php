<?php

declare(strict_types=1);

namespace Tests\TelemetrySystem;

use RacingCar\TelemetrySystem\TelemetryClient;
use RacingCar\TelemetrySystem\TelemetryDiagnosticControls;

class FakeTelemetryDiagnosticControls extends TelemetryDiagnosticControls
{
    public function __construct(protected TelemetryClient $telemetryClient)
    {
    }
}
