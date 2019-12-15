<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 29/11/19
 * Time: 10:10
 */

namespace App\Services;

use App\Util\TransformerInterface;
use Symfony\Component\HttpFoundation\RequestStack;


class TwitterClient
{
    private $transformer1;
    private $transformer;
    protected $requestStack;

    public function __construct(TransformerInterface $transformer1, $transformer, RequestStack $requestStack)
    {
        $this->transformer1 = $transformer1;
        $this->transformer = $transformer;
        $this->requestStack = $requestStack;
    }

    public function tweet($user, $key, $status)
    {
        $transformedStatus = $this->transformer1->transform($status);

        // ... connect to Twitter and send the encoded status

        $request = $this->requestStack->getCurrentRequest();
    }
}