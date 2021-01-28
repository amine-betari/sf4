<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 29/03/20
 * Time: 18:27
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Author;
use App\Entity\Cart;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\IsFalse;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Blank;
use Symfony\Component\Validator\Constraints\IsNull;
use Symfony\Component\Validator\Constraints\NotNull;

use Symfony\Component\Process\Process;


use Symfony\Component\ExpressionLanguage\ExpressionLanguage;



class ValidationController extends AbstractController
{

    /**
     *   @Route("/expression", name="expression", schemes="https")
     */
    public function expression(Request $request)
    {
        $value = $request->query->getAlpha('code', 'UNKNOWN');
        dd($value);

        $expressionLanguage = new ExpressionLanguage();

        dump($expressionLanguage->evaluate('1 + 2')); // displays 3

        $compile = $expressionLanguage->compile('1 + 2'); // displays (1 + 2)

        dump($compile);

        dump($expressionLanguage->evaluate($compile));

        dump($expressionLanguage->evaluate('"\\\\"'));

        $data = array('life' => 10, 'universe' => 10, 'everything' => 22);

        dump($expressionLanguage->evaluate(
            'data["life"] + data["universe"] + data["everything"]',
            array(
                'data' => $data,
            )
        ));

        $ret1 = $expressionLanguage->evaluate(
            'life == universe',
            array(
                'life' => 10,
                'universe' => 10,
                'everything' => 22,
            )
        );

        dump($ret1);

        $ret2 = $expressionLanguage->evaluate(
            'life < everything',
            array(
                'life' => 10,
                'universe' => 10,
                'everything' => 22,
            )
        );
        dump($ret2);
        die;
    }


    /**
     *   @Route("/validate", name="validate_list")
     */
    public function author(ValidatorInterface $validator)
    {

        dump('validate is True');

        $expectedTrue = 1; // 1 or true or !0

        $validator = Validation::createValidator();
        $violations = $validator->validate($expectedTrue, [new IsTrue()]);
        if (0 !== count($violations)) {
           // throw new \InvalidArgumentException('The value is not true !');
            dump('Violation');
        } else {
            dump('Pas de Violation');
        }

        dump('validate is False');
        $expectedTrue = '0'; // 0 or null or !true or !1 or false

        $validator = Validation::createValidator();
        $violations = $validator->validate($expectedTrue, [new IsFalse()]);

        if (0 !== count($violations)) {
           // throw new \InvalidArgumentException('The value is not false !');
            dump('Violation');
        } else {
            dump('Pas de Violation');
        }

        dump('validate is NotBlank');
        $expectedTrue = "0"; // meaning not equal to a blank string, a blank array, null or false

        $validator = Validation::createValidator();
        $violations = $validator->validate($expectedTrue, [new NotBlank()]);

        if (0 !== count($violations)) {
            // throw new \InvalidArgumentException('The value is not false !');
            dump('Violation');
        } else {
            dump('Pas de Violation');
        }

        dump('validate is Blank');
        $expectedTrue = ''; // or null

        $validator = Validation::createValidator();
        $violations = $validator->validate($expectedTrue, [new Blank()]);

        if (0 !== count($violations)) {
            // throw new \InvalidArgumentException('The value is not false !');
            dump('Violation');
        } else {
            dump('Pas de Violation');
        }

        dump('validate IsNull');
        $expectedTrue = null; // or null

        $validator = Validation::createValidator();
        $violations = $validator->validate($expectedTrue, [new IsNull()]);

        if (0 !== count($violations)) {
            // throw new \InvalidArgumentException('The value is not false !');
            dump('Violation');
        } else {
            dump('Pas de Violation');
        }


        dump('validate NotNull');
        $expectedTrue = null; // or null

        $validator = Validation::createValidator();
        $violations = $validator->validate($expectedTrue, [new NotNull()]);

        if (0 !== count($violations)) {
            // throw new \InvalidArgumentException('The value is not false !');
            dump('Violation');
        } else {
            dump('Pas de Violation');
        }
        die;

        $cart = new Cart;
        $author = new Author();
        $errors = $validator->validate($author);
        dump($errors);
        dump((string) $errors);
        return new Response((string) $errors);
        die;

        $author = new Author();

        $author->name = "";
        $author->genre = "non-fiction";
        $author->setFirstName("BE");

        // If validation fails, a non-empty list of errors (ConstraintViolationList) is returned
        $errors = $validator->validate($author, null, ['registration']);
        dump($errors);

        // Test Custom
        $emailConstraint = new Assert\Email();
        // all constraint "options" can be set this way
        $emailConstraint->message = 'Invalid email address';

        $testError = $validator->validate("amine.betari.gmail.com", $emailConstraint);
        dump($testError);

        if (count($errors) > 0) {
            /*
             * Uses a __toString method on the $errors variable which is a
             * ConstraintViolationList object. This gives us a nice string
             * for debugging.
             */
            $errorsString = (string) $errors;

            return new Response($errorsString);
        }

        return new Response("The author is valid Yes");
    }
}