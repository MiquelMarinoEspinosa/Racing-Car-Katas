<?php

declare(strict_types=1);

namespace RacingCar\TextConverter;

use RacingCar\TextConverter\TextManager\FileTextManager;

class HtmlTextConverter
{
    public function __construct(
        private string $fullFileNameWithPath,
        private ?FileTextManager $fileTextManager = null
    ) {
        $this->fileTextManager = $this->fileTextManager === null ? new FileTextManager() : $this->fileTextManager;
    }

    public function convertToHtml(): string
    {
        $f = $this->fileTextManager->fopen($this->fullFileNameWithPath, 'r');

        $html = '';
        while (($line = $this->fileTextManager->fgets($f)) !== false) {
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
}
