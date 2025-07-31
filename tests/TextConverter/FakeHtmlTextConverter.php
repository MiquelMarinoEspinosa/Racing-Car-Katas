<?php

declare(strict_types=1);

namespace Tests\TextConverter;

use RacingCar\TextConverter\HtmlTextConverter;

class FakeHtmlTextConverter extends HtmlTextConverter
{
    public function __construct(private string $text)
    {
    }

    protected function fopen(): mixed
    {
        return null;
    }

    protected function fgets(mixed $f): string | false
    {
        if ($this->text == '') {
            return false;
        }

        $text = $this->text;
        $this->text = '';

        return $text;
    }
}
