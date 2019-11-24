<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 04/11/19
 * Time: 17:04
 */

namespace App\Services;

use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class MailLogger
{
    private $adminEmail;

    private $params;

    public function __construct($adminEmail, ContainerBagInterface $params)
    {
        $this->adminEmail = $adminEmail;
        $this->params     = $params;
    }

    public function sendMail()
    {
        /* ... */
        dump($this->params->all());

    }
}