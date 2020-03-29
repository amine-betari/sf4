<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 05/01/20
 * Time: 12:10
 */

namespace App\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\OptionsResolver\OptionsResolver;

use App\Services\FileUploader;

class ImageTypeExtension extends AbstractTypeExtension
{

    private $fileUploader;

    public function __construct(FileUploader $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }
    // The Only method you must implement is the getExtendedType() function.
    // This is used to configure which field or field types you want to modify.
    /**
     * Returns the name of the type being extended.
     *
     * @return string The name of the type being extended
     */
    public function getExtendedType()
    {
        // use FormType::class to modify (nearly) every field in the system
        return FileType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        // makes it legal for FileType fields to have an image_property option
        $resolver->setDefined(array('pdf_property'));
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (isset($options['pdf_property'])) {
            // this will be whatever class/entity is bound to your form (e.g. Media)
            $parentData = $form->getParent()->getData();

            $imageUrl = null;
            $pdfUrl = null;
            if (null !== $parentData) {
                $accessor = PropertyAccess::createPropertyAccessor();
                $imageUrl = $accessor->getValue($parentData, $options['pdf_property']);
                $pdfUrl = $this->fileUploader->getTargetDirectory().'/'.$imageUrl;

            }

            // sets an "image_url" variable that will be available when rendering this field
            $view->vars['pdf_url'] = $pdfUrl;
        }
    }

}