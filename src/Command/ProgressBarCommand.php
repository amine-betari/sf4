<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 05/12/19
 * Time: 22:11
 */

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Process\Process;


use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\ConsoleEvents;

class ProgressBarCommand extends Command
{
    protected static $defaultName = 'app:progress-bar';


    protected function configure()
    {

    }
    public function execute(InputInterface $input, OutputInterface $output)
    {
         $dispatcher = new EventDispatcher();

         $dispatcher->addListener(ConsoleEvents::COMMAND, function (ConsoleCommandEvent $event) {
            // gets the input instance
            $input = $event->getInput();

            // gets the output instance
            $output = $event->getOutput();

            // gets the command to be executed
            $command = $event->getCommand();

            // writes something about the command
            $output->writeln(sprintf('Before running command <info>%s</info>', $command->getName()));

            // gets the application
            $application = $command->getApplication();
        });

        // creates a new progress bar (50 units)
        $progressBar = new ProgressBar($output, 50);
        // starts and displays the progress bar
        $progressBar->start();

        $i = 0;
        while ($i++ < 50) {
            // ... do some work

            // advances the progress bar 1 unit
            $progressBar->advance();

            // you can also advance the progress bar by more than 1 unit
            // $progressBar->advance(3);

        }

        $table = new Table($output);
        $table
            ->setHeaders(array('ISBN', 'Title', 'Author'))
            ->setRows(array(
                array('99921-58-10-7', 'Divine Comedy', 'Dante Alighieri'),
                array('9971-5-0210-0', 'A Tale of Two Cities', 'Charles Dickens'),
                array('960-425-059-0', 'The Lord of the Rings', 'J. R. R. Tolkien'),
                array('80-902734-1-6', 'And Then There Were None', 'Agatha Christie'),
            ))
        ;
        $table->render();
        // ensures that the progress bar is at 100%

        $helper = $this->getHelper('process');
        $process = new Process(array('figlet', 'Symfony'));

        $helper->run($output, $process);


        $progressBar->finish();
        $output->writeln(" ");

    }

}