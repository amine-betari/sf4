<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 02/12/19
 * Time: 23:09
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

use SensioLabs\AnsiConverter\AnsiToHtmlConverter;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

class SpoolController extends Controller
{
    /**
     * @Route("/send",
     *     name="send_console"
     * )
     */
    public function sendSpool($messages = 10, KernelInterface $kernel)
    {
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput(array(
            'command' => 'app:create-user',
            // (optional) define the value of command arguments
            'password' => 'barValue',
            // (optional) pass options to the command
        //    '--message-limit' => $messages,
        ));

        // You can use NullOutput() if you don't need the output
        $output = new BufferedOutput(
            OutputInterface::VERBOSITY_NORMAL,
            true // true for decorated
        );

        $application->run($input, $output);

        // return the output, don't use if you used NullOutput()
        // return the output
        $converter = new AnsiToHtmlConverter();
        $content = $output->fetch();

        // return new Response(""), if you used NullOutput()
        return new Response($converter->convert($content));
    }

}