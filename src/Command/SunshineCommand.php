<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 03/12/19
 * Time: 23:43
 */

namespace App\Command;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputArgument;

use Symfony\Component\Console\Input\InputOption;

use Symfony\Component\Console\Command\LockableTrait;

use Symfony\Component\Routing\RouterInterface;


class SunshineCommand extends Command
{

    use LockableTrait;

    protected static $defaultName = 'app:sunshine';
    private $logger;
    private $router;

    public function __construct(LoggerInterface $logger, RouterInterface $router)
    {
        $this->logger = $logger;
        $this->router = $router;

        // you *must* call the parent constructor
        parent::__construct();
    }

    protected function configure()
    {
        $this
          //  ->setName('app:sunshine')
            ->setHidden(false)
            ->setDescription('Good morning!');
          //  ->addArgument('name', InputArgument::REQUIRED, 'Who do you want to greet?')
          //  ->addArgument('last_name', InputArgument::REQUIRED, 'Your last name ?')
          //  ->addArgument('names', InputArgument::IS_ARRAY | InputArgument::REQUIRED, 'Who do you want to greet (separate multiple names with a space)?');
        $this
            // ...
            ->addOption('iterations','i',InputOption::VALUE_REQUIRED,'How many times should the message be printed?', null);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$this->lock()) {
            $output->writeln('The command is already running in another process.');

            return 0;
        }

        // If you prefer to wait until the lock is released, use this:
        // $this->lock(null, true);

        // ...

        // if not released explicitly, Symfony releases the lock
        // automatically when the execution of the command ends
        $this->release();

        $text = 'Hi ';
    /*    $text = 'Hi '.$input->getArgument('name');

        $lastName = $input->getArgument('last_name');
        if ($lastName) {
            $text .= ' '.$lastName;
        }

        $names = $input->getArgument('names');
        if (count($names) > 0) {
            $text .= ' '.implode(', ', $names);
        }
    */

        $output->writeln($text.'! en dehors de la boucle ');

        for ($i = 0; $i < $input->getOption('iterations'); $i++) {
            $output->writeln($text);
        }


        $context = $this->router->getContext();
        $context->setHost('example.com');
        $context->setScheme('https');
//        $context->setBaseUrl('my/path');

        $url = $this->router->generate('blog_list', array('param-name' => 'param-value'));
        $output->writeln($url);
    }
}