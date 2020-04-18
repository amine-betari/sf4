<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 08/04/20
 * Time: 19:14
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

use Symfony\Component\Yaml\Yaml;

class FileSystemController extends AbstractController
{
    /**
     *   @Route("/filesystem/{page}", name="filesystem", defaults={"title"="SALAM"})
     */
    public function system(Filesystem $fileSystem, Request $request)
    {
        dump($request);
        dump($request->attributes->get('title'));
        dump($request->attributes->get('_route'));
        dump($request->attributes->get('_route_params'));
     //   die;

        try {
            // mkdir creates directory recur... On POSIX filesystems. 0777
            // $fileSystem->mkdir(sys_get_temp_dir().'/'.random_int(0, 1000));

        } catch (IOExceptionInterface $exception) {
            echo "An error occurred while creating your directory at ".$exception->getPath();
        }


        // if this absolute directory exists, returns true
        $f1 = $fileSystem->exists('/tmp/539');
        dump($f1);

        // if rabbit.jpg exists and bottle.png does not exist, returns false
        // non-absolute paths are relative to the directory where the running PHP script is stored
        $f2 = $fileSystem->exists(array('rabbit.jpg', 'bottle.png'));
        dump($f2);


        // copy makes a copy of a single file
        // mirror makes a copy of directory

        // works only if image-ICC has been modified after image.jpg
        if ($fileSystem->exists(sys_get_temp_dir() . '/image.txt')) {
            $copy = $fileSystem->copy(sys_get_temp_dir() . '/image.txt', sys_get_temp_dir() . '/539/image2.txt', true);
            dump($copy);
        }
        // image.jpg will be overridden
        // $fileSystem->copy('image-ICC.jpg', 'image.jpg', true);

        // touch : sets access and modification time for a file
     //   $touch = $fileSystem->touch(sys_get_temp_dir().'/file.txt');
     //   dump($touch);

        // sets the owner of the lolcat video to www-data
        if ($fileSystem->exists('/tmp/fsile.txt')) {
            $chown = $fileSystem->chown(sys_get_temp_dir() . '/file.txt', 'www-data');
            dump($chown);
        }


        // sets the mode of the video to 0600
        if ($fileSystem->exists('/tmp/file.txt')) {
            $chmod = $fileSystem->chmod(sys_get_temp_dir().'/file.txt', 0600);
            dump($chmod);
        }


        // remove() deletes files, directories and symlinks:
        $remove = $fileSystem->remove(array(sys_get_temp_dir().'/95'));
        dump($remove);


        // renames a file
        if ($fileSystem->exists('/tmp/883')) {
            $fileSystem->rename('/tmp/883', '/tmp/539/amine', true);
        }

        $string = array("string" => "Multiple Line String");
        $yaml = Yaml::dump($string);
        Yaml::parse(date('Y-m-f', Yaml::PARSE_DATETIME));
        echo $yaml;

        if ($fileSystem->exists(sys_get_temp_dir(). '/file.txt')) {
            $fileSystem->symlink(sys_get_temp_dir(). '/file.txt', sys_get_temp_dir().'/souka/nour.txt');
        }

        // creates a temporary file with a unique filename, and returns its path, or throw an exception on failure:
        $tempnam = $fileSystem->tempnam('/tmp', 'prefix_');
        dump($tempnam);

        if ($fileSystem->exists(sys_get_temp_dir(). '/file.txt')) {
            $dumpFile = $fileSystem->dumpFile('/tmp/file.txt', "Préparation Symfony 4");
            dump($dumpFile);
           $appendToFile = $fileSystem->appendToFile('/tmp/file.txt', 'Email sent to abetari');
           dump($appendToFile);
        }
        die;
        return new Response("OK");
    }

}