<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 29/11/19
 * Time: 10:09
 */

namespace App\Util;


use Psr\Log\LoggerInterface;

class Rot13Transformer implements TransformerInterface
{
    private $logger;

    /**
     * @required
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;

    }
    public function transform($value)
    {
        $this->logger->info('Transforming '.$value);
        return str_rot13($value);
    }

}