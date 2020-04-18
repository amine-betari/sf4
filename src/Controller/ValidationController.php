<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 29/03/20
 * Time: 18:27
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Author;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ValidationController extends AbstractController
{

    /**
     *   @Route("/validate", name="validate_list")
     */
    public function author(ValidatorInterface $validator)
    {
        $author = new Author();

        $author->name = "";
        $author->genre = "non-fiction";
        $author->setFirstName("BE");

        // If validation fails, a non-empty list of errors (ConstraintViolationList) is returned
        $errors = $validator->validate($author, null, ['registration']);


        // Test Custom
        $emailConstraint = new Assert\Email();
        // all constraint "options" can be set this way
        $emailConstraint->message = 'Invalid email address';

        $testError = $validator->validate("amine.betari@gmail.com", $emailConstraint);
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