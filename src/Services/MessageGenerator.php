<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 28/11/19
 * Time: 11:36
 */

namespace App\Services;

use Psr\Log\LoggerInterface;

class MessageGenerator
{
    private $logger;
    private $logger1;

    public function __construct(LoggerInterface $logger, $logger1)
    {
        $this->logger = $logger;
        $this->logger1 = $logger1;
    }

    public function getHappyMessage()
    {
        $this->logger->info('nour nour ...');
        $messages = [
            'You did it! You updated the system! Amazing!',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going!',
        ];

        $index = array_rand($messages);

        return $messages[$index];
    }

}