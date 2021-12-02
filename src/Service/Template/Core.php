<?php

namespace Service\Template;

use Exception;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Service\App;

/**
 * @author Jayson Fong <contact@jaysonfong.org>
 */
class Core extends AbstractExtension
{

    public function getFunctions(): array
    {
        return [
            new TwigFunction('phrase', [$this, 'renderPhrase']),
            new TwigFunction('buildLink', [$this, 'buildLink'])
        ];
    }

    public function renderPhrase(string $phraseKey, array $variables = []): string
    {
        return App::phrase($phraseKey, $variables);
    }

    /**
     * @throws Exception
     */
    public function buildLink(string $link, array $args = [])
    {
        $app = App::getInstance();
        return $app->buildLink($link, $args);
    }

}