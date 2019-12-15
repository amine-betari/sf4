<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 09/12/19
 * Time: 09:46
 */

namespace App\Services;

/**
 * Coding standards demonstration.
 */
class FooBar
{
    const SOME_CONST = 42;

    /**
     * @var $fooBar
     */
    private $fooBar;

    /**
     * FooBar constructor.
     * @param string $dummy Some argument description
     */
    public function __construct(string $dummy)
    {
        $this->fooBar = $this->transformText($dummy);
    }

    /**
     * @return mixed
     *
     * @deprecated
     */
    public function someDeprecatedMethod()
    {
        @trigger_error(sprintf('The %s method is deprecated si,ce version 2.8 and will be removed in version 3.0'));

        return Baz::someMethod();
    }

    /**
     * Transforms the input given as first argument.
     *
     * @param bool|string $dummy    Some argument description
     * @param array       $options  An options collection to be used within the transformation
     *
     * @return bool|null|string
     *
     * @throws \RuntimeException When an invalid option is provided
     */
    private function transformText($dummy, array $options= array())
    {
        $defaultOptions = array(
            'some_default' => 'values',
            'another_default' => 'more values',
        );

        foreach ($options as $option) {
            if (!in_array($option, $defaultOptions)) {
                throw new \RuntimeException(sprintf('Unrecognized option "%s"', $option));
            }
        }

        $mergedOptions = array_merge(
            $defaultOptions,
            $options
        );

        if (true === $dummy) {
            return null;
        }

        if ('string' === $dummy) {
            if ('values' === $mergedOptions['some_default']) {
                return substr($dummy, 0, 5);
            }

            return ucwords($dummy);
        }
    }

    /**
     * Performs some basic check for a given value.
     *
     * @param null $value       Some value to check against
     * @param bool $theSwitch   Some switch to control the method's flow
     *
     * @return bool|void The resultant check if $theSwitch isn't false, void otherwise
     */
    private function reverseBoolean($value = null, $theSwitch = false)
    {
        if (!$theSwitch) {
            return;
        }

        return !$value;
    }

}