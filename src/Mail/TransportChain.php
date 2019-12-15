<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 01/12/19
 * Time: 01:05
 */

namespace App\Mail;


class TransportChain
{
    private $transports;

    public function __construct()
    {
        $this->transports = array();
    }

    public function addTransport(\Swift_Transport $transport, $alias)
    {
        $this->transports[$alias] = $transport;
    }

    public function getTransport($alias)
    {
        if (array_key_exists($alias, $this->transports)) {
            return $this->transports[$alias];
        }
    }

}