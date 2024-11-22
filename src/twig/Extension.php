<?php

namespace boilerplate\twig;

use Craft;
use Composer\InstalledVersions;
use craft\helpers\Html;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class Extension extends AbstractExtension
{
    const HEROICON_STYLES = [
        'outline' => '24/outline',
        'solid' => '24/solid',
        'mini' => '20/solid',
        'micro' => '16/solid',
    ];

    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'heroicon',
                [$this, 'getHeroicon'],
                ['is_safe' => ['html']],
            ),
        ];
    }

    /**
     * Returns the SVG source for the specified heroicon.
     * based on https://github.com/marcw/twig-heroicons
     * uses Heroicons https://heroicons.com/
     *
     * @param string $slug The slug of the icon to be rendered
     * @param string|null $style One of 'outline' / 'solid' /
     * 'mini'. Defaults to 'outline'.
     */
    public function getHeroicon(string $slug, ?string $style = null): string
    {
        // sanitise style, use first option as default
        if (!isset(self::HEROICON_STYLES[$style])) {
            $style = array_key_first(self::HEROICON_STYLES);
        }

        // figure out path and check it is readable
        $sourcePath = realpath(
            InstalledVersions::getInstallPath('tailwindlabs/heroicons'),
        );
        $path = sprintf(
            "$sourcePath/optimized/%s/$slug.svg",
            self::HEROICON_STYLES[$style],
        );

        return Html::svg($path);
    }
}
