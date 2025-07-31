<?php

declare(strict_types=1);

namespace Tests\TextConverter;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use RacingCar\TextConverter\HtmlTextConverter;
use RacingCar\TextConverter\TextManager\FileTextManager;

class HtmlTextConverterTest extends TestCase
{
    private const string FILE_PATH = '/path/foo';

    private FileTextManager | MockObject $mockedFileTextManager;
    private HtmlTextConverter $htmlTextConverter;

    protected function setUp(): void
    {
        $this->mockedFileTextManager = $this->createMock(
            FileTextManager::class
        );

        $this->htmlTextConverter = new HtmlTextConverter(
            self::FILE_PATH,
            $this->mockedFileTextManager
        );
    }

    public function testShouldReturnTheFileName(): void
    {
        $this->assertSame(
            self::FILE_PATH,
            $this->htmlTextConverter->getFileName()
        );
    }

    public function testUnitShouldConvertToHtmlWhenFileIsEmpty(): void
    {
        $this->mockedFileTextManager
            ->method('fopen')
            ->willReturn(new class{});

        $this->mockedFileTextManager
            ->method('fgets')
            ->willReturn(false);

        $this->assertSame(
            '',
            $this->htmlTextConverter->convertToHtml()
        );
    }

    public function testUnitShouldConvertToHtmlWhenFileIsNotEmpty(): void
    {
        $this->mockedFileTextManager
            ->method('fopen')
            ->willReturn(new class{});

        $this->mockedFileTextManager
            ->method('fgets')
            ->willReturnOnConsecutiveCalls(
                'This is not & empty < "text" ',
                false
            );

        $this->assertSame(
            'This is not &amp; empty &lt; &quot;text&quot;<br />',
            $this->htmlTextConverter->convertToHtml()
        );
    }
}
