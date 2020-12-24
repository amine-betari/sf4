<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 02/12/19
 * Time: 22:00
 */

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\PhpProcess;
use Symfony\Component\Process\PhpExecutableFinder;



class ProcessCm extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:process';

    protected function configure()
    {

        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Test Process Components.')
            ->setHelp('This command allows you to test Process ....')
        ;
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /////////////////////////////////////////////////
        $output->writeln('Process Test');
        $process = new Process('ls -a');
        //  $builder = new Process(array('ls', '-lsa'));
        //  $builder = new Process(array('ls', '-l', '-s', '-a'));
       // $process->setTimeout(3600);
        $process->run();
        // will send a SIGKILL to the process

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        $output->writeln($process->getOutput());

        /////////////////////////////////////////////////
        $output->writeln('Process Test Again');
        $process = new Process('mkdir testtestststt');
        $process->start();
        foreach ($process as $type => $data) {
            if ($process::OUT === $type) {
                echo "\nRead from stdout: ".$data;
            } else { // $process::ERR === $type
                echo "\nRead from stderr: ".$data;
            }
        }

        /////////////////////////////////////////////////
        $output->writeln('Process Test Again 2');
        $process = new Process('ping www.abetari.com -c 5');
        $process->run(function ($type, $buffer) {
            if (Process::ERR === $type) {
                echo 'ERR > '.$buffer;
            } else {
                echo 'OUT > '.$buffer;
            }
        });

        /////////////////////////////////////////////////
        $output->writeln('Process Test Again 3');
        $process     = new Process('ping www.google.fr -c 2');
        $process->start();
        $i = 0;
        while ($process->isRunning()) {
            // waiting for process to finish
            $output->writeln('MCO =>' . $i);
            $i++;
            $process->signal(SIGKILL);
            $process->stop(2, SIGINT);
        }
        $output->writeln($process->getOutput());

        /////////////////////////////////////////////////
        $output->writeln('Process Test Again 4');
        $process = new Process('ping www.google.fr -c 5');
        $process->start();
        // ... do other things
        $output->writeln('durring execution of command');
        // $process->wait();
        $process->wait(function ($type, $buffer) {
            if (Process::ERR === $type) {
                echo 'ERR > '.$buffer;
            } else {
                echo 'OUT > '.$buffer;
            }
        });
        $output->writeln('after execution of command');

        /////////////////////////////////////////////////
        $output->writeln('Process Test Again 6');
        $process = new PhpProcess(<<<EOF
    <?php echo 'Hello World'; ?>
EOF
        );
        $process->run();
        $output->writeln($process->getOutput());


        /////////////////////////////////////////////////
        $output->writeln('Process Test Again 7');
        $process = new Process('/usr/bin/php worker.php');
        $process->start();
        $pid = $process->getPid();
        $output->writeln($pid);

        /////////////////////////////////////////////////
        $output->writeln('Process Test Again 8');
        $phpBinaryFinder = new PhpExecutableFinder();
        $phpBinaryPath = $phpBinaryFinder->find();
        $output->writeln($phpBinaryPath);

        /////////////////////////////////////////////////
        $output->writeln('Process Test Again 9');
        $message = 'Hello world';
        $process = new PhpProcess(<<<EOF
    '<?php echo $message;'
EOF
        );
        $process->run();

        $output->writeln($process->getOutput());
    }
}