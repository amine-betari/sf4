<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 14/12/19
 * Time: 16:55
 */

namespace App\Util;

class Calculator
{
    public function add($a, $b)
    {
        return self::some($a, $b);
    }

    /**
     * @deprecated
     * @param $a
     * @param $b
     * @return mixed
     */
    public function some($a, $b)
    {
        return $a+$b;
    }
}