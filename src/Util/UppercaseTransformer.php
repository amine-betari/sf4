<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 29/11/19
 * Time: 10:44
 */

namespace App\Util;


class UppercaseTransformer implements TransformerInterface
{
    public function transform($value)
    {
        return strtoupper($value);
    }
}