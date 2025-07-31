<?php

declare(strict_types=1);

namespace Tests\TextConverter;

use RacingCar\TextConverter\HtmlTextConverter;
use RacingCar\TextConverter\TextManager\FileTextManager;

class FakeHtmlTextConverter extends HtmlTextConverter
{
    public function __construct(
        protected string $fullFileNameWithPath,
        private string $text,
        protected FileTextManager $fileTextManager
    ){
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
