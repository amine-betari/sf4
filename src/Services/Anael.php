<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 14/10/20
 * Time: 11:45
 */

namespace App\Services;



class Anael
{
    /**
     * Prioritized languages
     *
     * @var array
     */
    private $languages;

    public function __construct( array $languages = null)
    {
        $this->languages = $languages;
    }


    public function getTest()
    {
        return "OK OK Deprecated";
    }
}