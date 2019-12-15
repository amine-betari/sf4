<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 29/11/19
 * Time: 10:35
 */

namespace App\Util;


interface TransformerInterface
{
    public function transform($value);
}