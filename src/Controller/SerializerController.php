<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 05/04/20
 * Time: 17:52
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


use App\Model\Person;


class SerializerController extends AbstractController
{
    /**
     *   @Route("/serializer", name="serializer_list")
     */
    public function exempleOne(SerializerInterface $serializer)
    {
        // encoders
       // $encoders = array(new XmlEncoder(), new JsonEncoder());

        // normalizers
       // $normalizers = array(new ObjectNormalizer());

        // $serializer = new Serializer($normalizers, $encoders);


        // Exemple
        $person = new \App\Model\Person();
        $person->setName('foo');
        $person->setAge(99);
        $person->setSportsperson(false);
        dump($person);

        $jsonContent = $serializer->serialize($person, 'json');

        dump($jsonContent);


        return new Response($jsonContent);
    }

    /**
     *   @Route("/deserializer", name="deserializer_list")
     */
    public function exempleTwo(SerializerInterface $serializer)
    {
        $data = <<<EOF
<person>
    <name>foo</name>
    <age>99</age>
    <sportsperson>false</sportsperson>
  <!--   <city>Paris</city> -->
</person>
EOF;

        // this will throw a Symfony\Component\Serializer\Exception\ExtraAttributesException
        // because "city" is not an attribute of the Person class
        /* $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $normalizer = new ObjectNormalizer($classMetadataFactory);
        $serializer = new Serializer(array($normalizer)); */

        $person = $serializer->deserialize($data, Person::class, 'xml', array('allow_extra_attributes' => false));
        dump($person);
        dump('******************************************************************');
        $person = new Person();
        $person->setName('bar');
        $person->setAge(99);
        $person->setSportsperson(true);
        dump($person);

        $data = <<<EOF
<person>
    <name>AZARO</name>
    <age>25</age>
</person>
EOF;
        $person = $serializer->deserialize($data, Person::class, 'xml', array('object_to_populate' => $person));
        dump($person);
        die;

        return new Response($person);

    }

}