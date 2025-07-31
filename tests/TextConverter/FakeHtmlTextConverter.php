<?php

declare(strict_types=1);

namespace Tests\TextConverter;

use RacingCar\TextConverter\HtmlTextConverter;
use RacingCar\TextConverter\TextManager\FileTextManager;

class FakeHtmlTextConverter extends HtmlTextConverter
{
    public function __construct(
        protected string $fullFileNameWithPath,
        protected FileTextManager $fileTextManager
    ){
    }
}
