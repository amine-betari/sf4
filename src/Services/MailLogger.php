<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 04/11/19
 * Time: 17:04
 */

namespace App\Services;

class MailLogger
{
    private $adminEmail;

    public function __construct($adminEmail)
    {
        $this->adminEmail = $adminEmail;
    }

    public function sendMail()
    {
        /* ... */
    }
}