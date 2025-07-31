<?php

declare(strict_types=1);

namespace RacingCar\TextConverter\TextManager;

class FileTextManager
{
    public function fopen(string $filePath, string $mode): mixed
    {
        return fopen($filePath, $mode);
    }

    public function fgets(mixed $file): string | false
    {
        return fgets($file);
    }
}
