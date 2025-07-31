<?php

declare(strict_types=1);

namespace Tests\TextConverter;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use RacingCar\TextConverter\HtmlTextConverter;
use RacingCar\TextConverter\TextManager\FileTextManager;

class HtmlTextConverterTest extends TestCase
{
    private FileTextManager | MockObject $mockedFileTextManager;

    protected function setUp(): void
    {
        $this->mockedFileTextManager = $this->createMock(
            FileTextManager::class
        );
    }

    public function testShouldReturnTheFileName(): void
    {
        $fileName = '/path/foo';
        $converter = new HtmlTextConverter(
            $fileName,
            $this->mockedFileTextManager
        );
        $this->assertSame($fileName, $converter->getFileName());
    }

    public function testUnitShouldConvertToHtmlWhenFileIsEmpty(): void
    {
        $this->mockedFileTextManager
            ->method('fopen')
            ->willReturn(new class{});

        $this->mockedFileTextManager
            ->method('fgets')
            ->willReturn(false);

        $converter = new HtmlTextConverter(
            '/path/foo',
            $this->mockedFileTextManager
        );
        $this->assertSame('', $converter->convertToHtml());
    }

    public function testUnitShouldConvertToHtmlWhenFileIsNotEmpty(): void
    {
        $this->mockedFileTextManager
            ->method('fopen')
            ->willReturn(new class{});

        $this->mockedFileTextManager
            ->method('fgets')
            ->willReturnOnConsecutiveCalls('This is not & empty < "text" ', false);

        $converter = new HtmlTextConverter(
            '/path/foo',
            $this->mockedFileTextManager
        );

        $this->assertSame('This is not &amp; empty &lt; &quot;text&quot;<br />', $converter->convertToHtml());
    }
}
