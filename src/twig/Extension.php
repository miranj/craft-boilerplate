<?php

namespace boilerplate\twig;

use Craft;
use Composer\InstalledVersions;
use craft\helpers\Html;
use craft\web\View;
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

    // use to remember icons that have already been rendered
    // in full at least once during this request
    protected array $renderCache = [];
    public bool $cacheSvg = false;

    public function __construct(View $view)
    {
        $view->hook('cache-svg-shapes', function () {
            $this->cacheSvg = true;
        });
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'heroicon',
                [$this, 'getHeroicon'],
                ['is_safe' => ['html']],
            ),
            new TwigFunction(
                'svgIcon',
                [$this, 'getSvgIcon'],
                ['is_safe' => ['html']],
            ),
        ];
    }

    /**
     * Returns the SVG source for the specified alias or Heroicon.
     * Forces sanitisation and namespacing.
     *
     * @param string $pathOrSlug Path (or alias) to an SVG file.
     * Can also be of the format `heroicon:arrow-left:solid` to
     * fetch the Solid variant of the `arrow-left` Heroicon from
     * https://github.com/tailwindlabs/heroicons. The variant part
     * defaults to Outline when missing, eg: `heroicon:arrow-left`.
     */
    public function getSvgIcon(string $pathOrSlug): string
    {
        $svg = '';
        $path = $pathOrSlug;

        if (stripos(trim($pathOrSlug), 'heroicon:') === 0) {
            // treat input as a heroicon slug of the format:
            //      heroicon:arrow-left
            //      heroicon:arrow-left:solid
            [, $slug, $style] = explode(':', $pathOrSlug . ':');
            $path = $this->getHeroiconPath($slug, $style);
        }

        if ($path) {
            $svg = Html::svg($path, true, true);
        }

        // enable <use href="#id"> for repeat instances of the same icon
        if ($svg && ($retcon = Craft::$app->plugins->getPlugin('retcon'))) {
            if (!isset($this->renderCache[$path])) {
                // first render
                $id = Html::id(basename($path, '.svg') . rand());

                // wrap all contents of the SVG inside a <symbol>
                $symbol = $retcon->retcon->wrap($svg, 'svg', 'symbol#' . $id);
                $symbol = $retcon->retcon->change($symbol, 'svg', false);

                // empty <svg>, insert <symbol> and <use> that symbold
                $svg = $retcon->retcon->inject($svg, 'svg', $symbol, true);
                $svg = $retcon->retcon->inject(
                    $svg,
                    'svg',
                    '<use href="#' . $id . '" />',
                );

                // cache for repeat instances
                if ($this->cacheSvg) {
                    $this->renderCache[$path] = $id;
                }
            } else {
                // repeat instance: empty <svg>, insert <use>
                $id = $this->renderCache[$path];
                $svg = $retcon->retcon->inject(
                    $svg,
                    'svg',
                    '<use href="#' . $id . '" />',
                    true,
                );
            }
        }

        return $svg;
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
        return $this->getSvgIcon($this->getHeroiconPath($slug, $style));
    }

    protected function getHeroiconPath(
        string $slug,
        ?string $style = null,
    ): string {
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

        return $path;
    }
}
