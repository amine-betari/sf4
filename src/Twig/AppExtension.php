<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 06/11/19
 * Time: 10:59
 */

namespace App\Twig;

use Some\LipsumGenerator;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{

    /**
     * @return array|TwigFilter[]
     */
    public function getFilters()
    {
        return [
            new TwigFilter('price', [$this, 'filterPrice']),
        ];
    }

    /**
     * @return array|TwigFunction[]
     */
    public function getFunctions()
    {
        return [
            // appellera la fonction LipsumGenerator:generate()
            new TwigFunction('lipsum', [$this, 'generate']),
        ];
    }

    /**
     * @param $number
     * @param int $decimals
     * @return string
     */
    public function filterPrice($number, $decimals = 0)
    {
        $price = number_format($number, $decimals);
        $price = $price . '€';

        return $price;
    }

    public function generate()
    {
        return 'generate App Extension ';
    }
}
