<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 04/01/20
 * Time: 12:37
 */

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ShippingType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => array(
                'Standard Shipping' => 'standard',
                'Expedited Shipping' => 'expedited',
                'Priority Shipping' => 'priority',
            ),
        ));
    }

    public function getParent()
    {
        // the return of this function indicates that you're extending the ChoiceType field

        // buildForm() : Each field type has a buildForm method, which is where you configure and build any field(s)
        // Notice that this is the same method you use to setup your forms

        // buildView() : This method is used to set any extra variables you will need when rendering your filed in a template.

        // configureOptions() :

        return ChoiceType::class;
    }
}