<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 05/12/19
 * Time: 00:18
 */

namespace App\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Style\SymfonyStyle;

class StyleCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'app:style';

    protected function configure()
    {
        $this->addArgument('password', InputArgument::REQUIRED , 'User password');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(array(
            '<info>Lorem Ipsum Dolor Sit Amet s</>',
            '<info>==========================</>',
            '',
        ));


        $io = new SymfonyStyle($input, $output);

        // displays a progress bar of unknown length
        $io->progressStart();

        // displays a 100-step length progress bar
        $io->progressStart(100);

        $io->section('Adding a User');

        $io->title('Lorem Ipsum Dolor Sit Amet s'.  $input->getArgument('password'));

        $io->section('Generating the Password');

        // consider using arrays when displaying long messages
        $io->text(array(
            'Lorem ipsum dolor sit amet',
            'Consectetur adipiscing elit',
            'Aenean sit amet arcu vitae sem faucibus porta',
        ));
        $output->writeln("");
        // outputs a single blank line
        $io->newLine();



        $io->listing(array(
            'Element #1 Lorem ipsum dolor sit amet',
            'Element #2 Lorem ipsum dolor sit amet',
            'Element #3 Lorem ipsum dolor sit amet',
        ));
        // outputs three consecutive blank lines
        $io->newLine(3);

        $io->table(
            array('Header 1', 'Header 2'),
            array(
                array('Cell 1-1', 'Cell 1-2'),
                array('Cell 2-1', 'Cell 2-2'),
                array('Cell 3-1', 'Cell 3-2'),
            )
        );

        // use simple strings for short notes
        $io->note('Lorem ipsum dolor sit amet');

// ...

        // consider using arrays when displaying long notes
        $io->note(array(
            'Lorem ipsum dolor sit amet',
            'Consectetur adipiscing elit',
            'Aenean sit amet arcu vitae sem faucibus porta',
        ));

        // use simple strings for short caution message
        $io->caution('Lorem ipsum dolor sit amet');

// ...

        // consider using arrays when displaying long caution messages
        $io->caution(array(
            'Lorem ipsum dolor sit amet',
            'Consectetur adipiscing elit',
            'Aenean sit amet arcu vitae sem faucibus porta',
        ));



        // advances the progress bar 1 step
        //$io->progressAdvance();

// advances the progress bar 10 steps
       // $io->progressAdvance(10);

        $io->progressFinish();

        $io->ask('What is your name?');
        $name = $io->ask('Where are you from?', 'United States');
        $io->text($name);

        $io->ask('Number of workers to start', 1, function ($number) {
                    if (!is_numeric($number)) {
                        throw new \RuntimeException('You must type a number.');
                    }

                    return (int) $number;
              }
        );

        $io->askHidden('What is your password?');

        // validates the given answer
        $io->askHidden('What is your password?', function ($password) {
            if (empty($password)) {
                throw new \RuntimeException('Password cannot be empty.');
            }

            return $password;
        });

        $io->confirm('Restart the web server?');

        $io->choice('Select the queue to analyze', array('queue1', 'queue2', 'queue3'), 'queue1');

        // use simple strings for short success messages
        $io->success('Lorem ipsum dolor sit amet');

// ...

// consider using arrays when displaying long success messages
        $io->success(array(
            'Lorem ipsum dolor sit amet',
            'Consectetur adipiscing elit',
        ));

        // use simple strings for short warning messages
        $io->warning('Lorem ipsum dolor sit amet');

// ...

// consider using arrays when displaying long warning messages
        $io->warning(array(
            'Lorem ipsum dolor sit amet',
            'Consectetur adipiscing elit',
        ));

        // use simple strings for short error messages
        $io->error('Lorem ipsum dolor sit amet');

// ...

    // consider using arrays when displaying long error messages
        $io->error(array(
            'Lorem ipsum dolor sit amet',
            'Consectetur adipiscing elit',
        ));

        // Write to the standard output
        $io->write('Reusable information');

    // Write to the error output
        $io->getErrorStyle()->warning('Debugging information or errors');
    }

}