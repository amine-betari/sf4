<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 05/12/19
 * Time: 21:30
 */

namespace App\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Question\ChoiceQuestion;

class HelperCommand extends Command
{
    protected static $defaultName = 'app:helper';

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');

        $question = new ConfirmationQuestion('Continue with this action?', false);
        if (!$helper->ask($input, $output, $question)) {
            return;
        } else {
            $output->writeln("TO DO");
        }

        // ...
        $question = new Question('Please enter the name of the bundle', 'AcmeDemoBundle');
        $question->setValidator(function ($answer) {
            if (!is_string($answer) || 'Bundle' !== substr($answer, -6)) {
                throw new \RuntimeException(
                    'The name of the bundle should be suffixed with \'Bundle\''
                );
            }

            return $answer;
        });
        $question->setMaxAttempts(2);
        $bundleName = $helper->ask($input, $output, $question);
        $output->writeln($bundleName);

        $question = new ChoiceQuestion(
            'Please select your favorite color (defaults to red)',
            array('red', 'blue', 'yellow'),
            0
        );
        $question->setErrorMessage('Color %s is invalid.');
        $color = $helper->ask($input, $output, $question);
        $output->writeln('You have just selected: '.$color);

        $bundles = array('AcmeDemoBundle', 'AcmeBlogBundle', 'AcmeStoreBundle');
        $question = new Question('Please enter the name of a bundle', 'FooBundle');
        $question->setAutocompleterValues($bundles);
        $bundleName = $helper->ask($input, $output, $question);
        $output->writeln($bundleName);


        $question = new Question('What is the database password?');
        $question->setHidden(true);
        $question->setHiddenFallback(false);

        $password = $helper->ask($input, $output, $question);
        $output->writeln($password);

        $formatter = $this->getHelper('formatter');
        // Print Messages in a Section
        $formattedLine = $formatter->formatSection(
            'SomeSection',
            'Here is some message related to that section'
        );
        $output->writeln($formattedLine);

        // Print Messages in a Block
        $errorMessages = array('Error!', 'Something went wrong');
        $formattedBlock = $formatter->formatBlock($errorMessages, 'error');
        $output->writeln($formattedBlock);

        // Print Truncated Messages
        $message = "This is a very long message, which should be truncated";
        $truncatedMessage = $formatter->truncate($message, 7);
        $output->writeln($truncatedMessage);
    }
}