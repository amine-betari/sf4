<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 27/03/20
 * Time: 16:51
 */

namespace App\Printing;


class Printer
{

    public function registerFormatter($format, $formatter)
    {
       dump($format);
       dump($formatter);

    }

    public function print($format, $message)
    {

    }

}