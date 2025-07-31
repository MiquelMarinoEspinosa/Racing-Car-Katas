<?php

declare(strict_types=1);

namespace RacingCar\TextConverter\TextManager;

class FileTextManager
{
    public function fopen(string $filePath): mixed
    {
        return fopen($filePath, 'r');
    }

    public function fgets(mixed $file): string | false
    {
        return fgets($file);
    }
}
