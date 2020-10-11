<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 19/04/20
 * Time: 15:14
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Customer;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
           ->add('firstName', TextType::class)
           ->add('lastName', TextType::class);

        $builder->add('location', LocationType::class, [
            'data_class' => Customer::class,
        ]);

        $builder ->add('save', SubmitType::class, array('label' => 'Create Customer'));
    }

}