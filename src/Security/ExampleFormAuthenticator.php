<?php

// src/Security/ExampleFormAuthenticator.php
// ...
namespace App\Security;

use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;


use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Csrf\CsrfToken;


class ExampleFormAuthenticator extends AbstractFormLoginAuthenticator
{
    private $csrfTokenManager;

    public function __construct(CsrfTokenManagerInterface $csrfTokenManager)
    {
        $this->csrfTokenManager = $csrfTokenManager;
    }



    public function supports(Request $request)
    {
    }

    protected function getLoginUrl()
    {
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    public function getCredentials(Request $request)
    {
        $csrfToken = $request->request->get('_csrf_token');

        if (false === $this->csrfTokenManager->isTokenValid(new CsrfToken('authenticate', $csrfToken))) {
            throw new InvalidCsrfTokenException('Invalid CSRF token.');
        }

        // ... all your normal logic
    }

    // ...

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // on success, let the request continue
        return null;
    }
}