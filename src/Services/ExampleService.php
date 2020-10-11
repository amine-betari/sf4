<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 23/05/20
 * Time: 01:34
 */

namespace App\Services;


use Symfony\Component\Security\Core\Security;

class ExampleService
{
    private $security;

    public function __construct(Security $security)
    {
        // Avoid calling getUser() in the constructor: auth may not
        // be complete yet. Instead, store the entire Security object.
        $this->security = $security;
    }

    public function someMethod()
    {
        // returns User object or null if not authenticated
        $user = $this->security->getUser();
    }
}