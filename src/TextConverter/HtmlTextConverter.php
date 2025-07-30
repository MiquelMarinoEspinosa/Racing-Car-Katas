<?php

declare(strict_types=1);

namespace RacingCar\TextConverter;

class HtmlTextConverter
{
    public function __construct(
        private string $fullFileNameWithPath
    ) {
    }

    public function convertToHtml(): string
    {
        $f = $this->fopen();

        $html = '';
        while (($line = $this->fgets($f)) !== false) {
            $line = rtrim($line);
            $html .= htmlspecialchars($line, ENT_QUOTES | ENT_HTML5);
            $html .= '<br />';
        }
        return $html;
    }

    public function getFileName(): string
    {
        return $this->fullFileNameWithPath;
    }

    private function fopen(): mixed
    {
        return fopen($this->fullFileNameWithPath, 'r');
    }

    private function fgets(mixed $f): string | false
    {
        return fgets($f);
    }
}
