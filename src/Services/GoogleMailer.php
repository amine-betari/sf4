<?php

namespace App\Services;

use Symfony\Component\OptionsResolver\OptionsResolver;

class GoogleMailer extends Mailer
{
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);


        if ($resolver->isRequired('host')) {
            // ...
        }

        $requiredOptions = $resolver->getRequiredOptions();

        $resolver->setDefaults([
            'host' => 'smtp.google.com',
            'encryption' => 'ssl',
        ]);
    }
}