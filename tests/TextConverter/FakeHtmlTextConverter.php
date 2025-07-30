<?php

declare(strict_types=1);

namespace Tests\TextConverter;

use RacingCar\TextConverter\HtmlTextConverter;

class FakeHtmlTextConverter extends HtmlTextConverter
{
    private bool $textProcessed = false;

    public function __construct(private string $text)
    {
        $this->textProcessed = $text === '';
    }

    protected function fopen(): mixed
    {
        return null;
    }

    protected function fgets(mixed $f): string | false
    {
        if ($this->textProcessed) {
            return false;
        }

        $this->textProcessed = true;
        return $this->text;
    }
}
