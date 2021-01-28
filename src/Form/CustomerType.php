<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 19/04/20
 * Time: 15:14
 */

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
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


        // TEST CONSTRAINT DEBUT
        $builder->add('foo', TextType::class);
        $builder->add('foo2', TextType::class);
        $builder->add('bar', TextType::class);
        $builder->add('bar2', TextType::class);
        $builder->add('age', TextType::class);
        $builder->add('startDate', null,   [
            'mapped' => false,
            'html5'  => true,
            'widget' => 'single_text',
            ]
        );
        $builder->add('endDate', DateTimeType::class,   [
                'mapped' => false,
                'html5'  => true,
                'widget' => 'single_text',
            ]
        );

        $builder->add('deliveryDate', DateTimeType::class);
        $builder->add('description', TextType::class);


        $builder->add('category', TextType::class);
        $builder->add('isTechnicalPost', TextType::class);
        // TEST CONSTRAINT FIN

        // Test différents FormType
        $builder->add('email', EmailType::class, [
            'mapped' => false,
        ]);
        $builder->add('range', RangeType::class, [
            'mapped' => false,
            'attr' => [
                'min' => 5,
                'max' => 15,
            ]
        ]);
        $builder->add('search', SearchType::class, [
            'mapped' => false,
        ]);
        $builder->add('url', UrlType::class, [
            'mapped' => false,
        ]);

        $builder->add('tel', TelType::class, [
            'mapped' => false,
        ]);

        $builder->add('dateInterval', DateIntervalType::class, [
            'mapped' => false,
            'widget' => 'integer',
            // render a text field for each part
            // 'input'    => 'string',  // if you want the field to return a ISO 8601 string back to you
        ]);

        $builder->add('fruits', ChoiceType::class, [
            'mapped' => false,
            'choices' => [
                'Apple' => 1,
                'Banana' => 2,
                'Durian' => 3,
            ],
            'choice_attr' => [
                'Apple' => ['data-color' => 'Red'],
                'Banana' => ['data-color' => 'Yellow'],
                'Durian' => ['data-color' => 'Green'],
            ],
            'choice_label' => function ($value, $key, $index) {
                return $key;
            }
        ]);

        $builder->add('dateTime', DateTimeType::class, [
            'mapped' => false,
           // 'widget' => 'choice',
            'with_minutes' => false,

        ]);

        $builder->add('number', NumberType::class, [
            'mapped' => false,
        ]);

        $builder->add('money', MoneyType::class, [
            'mapped' => false,
        ]);

        $builder->add('integer', IntegerType::class, [
            'mapped' => false,
        ]);

        $builder->add('percent', PercentType::class, [
            'mapped' => false,
        ]);
        $builder->add('birthday', BirthdayType::class, [
            'mapped' => false,
        ]);
        $builder->add('myfield', TextType::class, [
            'mapped' => false,
            'data' => 'bar',
            'empty_data' => 'none'
        ]);
        $builder->add('date', DateType::class, [
            'mapped' => false,
            'html5'  => true,
            'widget' => 'single_text',
        ]);


        $builder ->add('save', SubmitType::class, array('label' => 'Create Customer'));
    }

}