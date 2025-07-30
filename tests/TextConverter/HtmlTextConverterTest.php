<?php

declare(strict_types=1);

namespace Tests\TextConverter;

use PHPUnit\Framework\TestCase;
use RacingCar\TextConverter\HtmlTextConverter;

class HtmlTextConverterTest extends TestCase
{
    public function testFoo(): void
    {
        $fileName = 'foo';
        $converter = new HtmlTextConverter($fileName);
        $this->assertSame($fileName, $converter->getFileName());
    }
}
