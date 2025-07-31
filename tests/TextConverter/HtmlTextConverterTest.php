<?php

declare(strict_types=1);

namespace Tests\TextConverter;

use PHPUnit\Framework\TestCase;
use RacingCar\TextConverter\HtmlTextConverter;
use RacingCar\TextConverter\TextManager\FileTextManager;

class HtmlTextConverterTest extends TestCase
{
    public function testShouldReturnTheFileName(): void
    {
        $fileName = '/path/foo';
        $converter = new HtmlTextConverter(
            $fileName,
            $this->createMock(FileTextManager::class)
        );
        $this->assertSame($fileName, $converter->getFileName());
    }

    public function testUnitShouldConvertToHtmlWhenFileIsEmpty(): void
    {
        $mockedFileTextManager = $this->createMock(FileTextManager::class);

        $mockedFileTextManager
            ->method('fopen')
            ->willReturn(new class{});

        $mockedFileTextManager
            ->method('fgets')
            ->willReturn(false);

        $converter = new HtmlTextConverter(
            '/path/foo',
            $mockedFileTextManager
        );
        $this->assertSame('', $converter->convertToHtml());
    }

    public function testUnitShouldConvertToHtmlWhenFileIsNotEmpty(): void
    {
        $mockedFileTextManager = $this->createMock(FileTextManager::class);

        $mockedFileTextManager
            ->method('fopen')
            ->willReturn(new class{});

        $mockedFileTextManager
            ->method('fgets')
            ->willReturnOnConsecutiveCalls('This is not & empty < "text" ', false);

        $converter = new HtmlTextConverter(
            '/path/foo',
            $mockedFileTextManager
        );

        $this->assertSame('This is not &amp; empty &lt; &quot;text&quot;<br />', $converter->convertToHtml());
    }
}
