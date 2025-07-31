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
        $converter = new HtmlTextConverter($fileName);
        $this->assertSame($fileName, $converter->getFileName());
    }

    public function testShouldConvertToHtmlWhenFileIsEmpty(): void
    {
        $fileName = '/app/tests/TextConverter/empty.txt';
        $converter = new HtmlTextConverter($fileName);
        $this->assertSame('', $converter->convertToHtml());
    }

    public function testShouldConvertToHtmlWhenFileIsNotEmpty(): void
    {
        $fileName = '/app/tests/TextConverter/not_empty.txt';
        $converter = new HtmlTextConverter($fileName);
        $this->assertSame('This is not &amp; empty &lt; &quot;text&quot;<br />', $converter->convertToHtml());
    }

    public function testUnitShouldConvertToHtmlWhenFileIsEmpty(): void
    {
        $converter = new FakeHtmlTextConverter(
            '/path/foo',
            '',
            $this->createMock(FileTextManager::class)
        );
        $this->assertSame('', $converter->convertToHtml());
    }

    public function testUnitShouldConvertToHtmlWhenFileIsNotEmpty(): void
    {
        $converter = new FakeHtmlTextConverter(
            '/path/foo',
            'This is not & empty < "text" ',
            $this->createMock(FileTextManager::class)
        );
        $this->assertSame('This is not &amp; empty &lt; &quot;text&quot;<br />', $converter->convertToHtml());
    }
}
