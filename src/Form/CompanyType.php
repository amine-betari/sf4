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
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Company;
use Symfony\Component\OptionsResolver\OptionsResolver;


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

        $builder->add('email', EmailType::class);
        $builder->add('password', PasswordType::class);
        $builder->add('city2', TextType::class);

        $builder->add('username', TextType::class);
        $builder->add('passwordA', PasswordType::class);

        $builder ->add('save', SubmitType::class, array('label' => 'Create Company'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
            // 'validation_groups' => ['registration', 'Company'],
          //  'validation_groups' => ['Default'],
         //   'validation_groups' => ['registration'],
         //   'validation_groups' => ['Default', 'registration'],
        ]);
    }
}