<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 19/04/20
 * Time: 15:13
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Company;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('website', TextType::class);

        $builder->add('location', LocationType::class, [
            'data_class' => Company::class,
        ]);

        $builder ->add('save', SubmitType::class, array('label' => 'Create Company'));
    }

}