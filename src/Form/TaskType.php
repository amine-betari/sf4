<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 12/01/20
 * Time: 15:12
 */

namespace App\Form;

use App\Entity\Task;
use App\Form\Type\ShippingType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\CallbackTransformer;

use Symfony\Component\OptionsResolver\OptionsResolver;

use App\Form\DataTransformer\IssueToNumberTransformer;
use App\Form\Type\IssueSelectorType;

class TaskType extends AbstractType
{

    private $transformer;

    public function __construct(IssueToNumberTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
     //   parent::buildForm($builder, $options); // TODO: Change the autogenerated stub
        $builder
        ->add('task', null, array('label' => 'Nour', 'attr' => array('maxlength' => 4)))
        ->add('dueDate', DateType::class,  array('widget' => 'single_text'))
        ->add('agreeTerms', CheckboxType::class, array('mapped' => false))
        ->add('save', SubmitType::class, array('label' => 'Create Task'))
        ->add('shipping_code', ShippingType::class, array(
            'placeholder' => 'Choose a delivery option',
            'mapped'       => false,
        ));

        // Tags
        $builder->add('tags', TextType::class);
            $builder->get('tags')
                ->addModelTransformer(new CallbackTransformer(
                    function ($tagsAsArray) {
                     //   $tagsAsArray = ['tag1', 'tag2', 'tag3'];
                     //   $tagsAsArray = is_array($tagsAsArray) ?: [];

                        if (null === $tagsAsArray) {
                            return '';
                        }
                        // transform the array to a string
                        // transform the original value into a format that'll be used to render the field
                        return implode(', ', $tagsAsArray);
                    },
                    function ($tagsAsString) {
                        if (null === $tagsAsString || '' === $tagsAsString) {
                            return [];
                        }
                        // transform the string back to an array
                        // it transforms the submitted value back into the format you will use
                        return explode(', ', $tagsAsString);
                    }
                ))
                // The addModelTransformer() method accepts any object that implements DataTransformerInterface
        ;


        $builder
            ->add('description', TextareaType::class, array('mapped' => false))
            ->add('issue', TextType::class, array (
                'mapped' => false,
                // validation message if the data transformer fails
                'invalid_message' => 'That is not a valid issue number HAHAHHA',
                )
            );

        $builder->get('issue')
            ->addModelTransformer($this->transformer);

        $builder->add('issue2', IssueSelectorType::class, array("mapped" => false));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
//            'validation_groups' => new GroupSequence(['First', 'Second']),
        ]);
    }
}