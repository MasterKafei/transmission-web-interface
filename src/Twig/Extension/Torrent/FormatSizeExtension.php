<?php

namespace App\Twig\Extension\Torrent;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class FormatSizeExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('formatSize', [$this, 'formatSize']),
        ];
    }

    public function formatSize($size): string
    {
        $units = ['o', 'Ko', 'Mo', 'Go', 'To'];
        $base = 1024;
        $i = 0;

        while ($size > $base && $i < count($units) - 1) {
            $size /= $base;
            $i++;
        }

        return round($size, 2) . ' ' . $units[$i];
    }
}
