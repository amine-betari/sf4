<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;


class YamlController extends AbstractController
{

    /**
     * @Route("/yaml", name="yaml")
     */
    public function yaml(Request $request)
    {
        // 1er cas
        try {
            $value = Yaml::parse("foo: bar");
            dump($value);
        } catch (ParseException $exception) {
            dump('Unable to parse the YAML string: %s', $exception->getMessage());
        }

        // 2eme cas
        try {
            $value = Yaml::parseFile("/tmp/cache.yaml");
            dump($value);
        } catch (ParseException $exception) {
            dump('Unable to parse the YAML string: %s', $exception->getMessage());
        }

        // 3eme cas
        $array = array(
            'keyA' => 'bar',
            'keyB' => array('key1' => 'bar', 'key2' => 'baz'),
        );

        try {
      /*      $yaml = Yaml::dump($array, 2, 8);
            echo $yaml;

            file_put_contents('/tmp/cache.yaml', $yaml);*/
        } catch (ParseException $exception) {
            dump('Unable to parse the YAML string: %s', $exception->getMessage());
        }

        // 4eme cas
        try {
            $object = new \stdClass();
            $object->foo = 'bar';

            $dumped = Yaml::dump($object, 2, 4, Yaml::DUMP_OBJECT);
            dump($dumped);

            $parsed = Yaml::parse($dumped, Yaml::PARSE_OBJECT);
            dump($parsed->foo); // bar
        } catch (ParseException $exception) {
            dump('Unable to parse the YAML string: %s', $exception->getMessage());
        }

        // 5eme cas
        dump(Yaml::parse('2016-05-27')); // 1464307200;

        $date = Yaml::parse('2016-05-27', Yaml::PARSE_DATETIME);
        dump(($date)); // DateTime
        dump(get_class($date)); // DateTime


        // 6eme cas
        $string = array("string" => "Multiple\nLine\nString");
        $yaml = Yaml::dump($string);
        dump($yaml); // string: "Multiple\nLine\nString"

        $string = array("string" => "Multiple
Line
String");
        $yaml = Yaml::dump($string);
        dump($yaml);

        $string = array("string" => "Multiple\nLine\nString");
        $yaml = Yaml::dump($string, 2, 4, Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK);
        dump($yaml);
        die;
    }
}