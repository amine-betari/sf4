<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 30/03/20
 * Time: 11:21
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

// The Annotation is neccessary for this new constraint in order to make it available for use in classes (entity) via annotations

/**
 * @Annotation
 */
class ContainsAlphanumeric extends Constraint
{
    public $message = 'The string "{{ string }}" contains an illegal character: it can only contain letters or numbers.';

}