<?php

namespace App\Services;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\Options;

class Mailer
{

    public $options = [];

    public function __construct(array $options = [])
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        // Merges options with the default values stored in the container and validataes them
        $this->options = $resolver->resolve($options);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'host'       => 'smtp.example.org',
            'username'   => 'user',
            'password'   => 'pa$$word',
            'port'       => 25,
            'encryption' => null,
        ]);

        $resolver->setRequired('host');
        // $mailer = new Mailer(); ===> MissingOptionsException: The required option "host" is missing.
        $resolver->setRequired(['host', 'username', 'password']);

        // Type Validation

        // specify one allowed type
        $resolver->setAllowedTypes('host', 'string');

        // specify multiple allowed types
        $resolver->setAllowedTypes('port', ['null', 'int']);

        // check all items in an array recursively for a type
        $resolver->setAllowedTypes('dates', 'DateTime[]');
        $resolver->setAllowedTypes('ports', 'int[]');

        // Value Validation
        $resolver->setDefault('transport', 'sendmail');
        $resolver->setAllowedValues('transport', ['sendmail', 'mail', 'smtp']);

        // Sometimes, option values need to be normalized before you can use them.
        // For instance, assume that the host should always start with http://.
        // To do that, you can write normalizers.
        // Normalizers are executed after validating an option.+++++++++++
        // You can configure a normalizer by calling setNormalizer():
        $resolver->setNormalizer('host', function (Options $options, $value) {
            if ('http://' !== substr($value, 0, 7) && 'https://' !== substr($value, 0, 8)) {
                if ('ssl' === $options['encryption']) {
                    $value = 'https://'.$value;
                } else {
                    $value = 'http://'.$value;
                }
            }

            return $value;
        });


        // Default Values that Depend on another Option
        $resolver->setDefault('encryption', null);
        // The closure is only executed if the port option isn’t set by the user or overwritten in a sub-class.
        $resolver->setDefault('port', function (Options $options) {
            if ('ssl' === $options['encryption']) {
                return 465;
            }

            return 25;
        });

        // You can use setDefined() to define an option without setting a default value
        $resolver->setDefined('port');
        $resolver->setDefined(['port', 'encryption']);
    }
}