<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 27/03/20
 * Time: 16:50
 */

namespace App\Printing;


interface FormatterInterface
{

    public function format($message);
}