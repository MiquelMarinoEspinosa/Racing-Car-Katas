<?php

declare(strict_types=1);

namespace RacingCar\TextConverter;

use RacingCar\TextConverter\TextManager\FileTextManager;

class HtmlTextConverter
{
    protected FileTextManager $fileTextManager;

    public function __construct(
        protected string $fullFileNameWithPath
    ) {
        $this->fileTextManager = new FileTextManager();
    }

    public function convertToHtml(): string
    {
        $f = $this->fileTextManager->fopen($this->fullFileNameWithPath);

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
