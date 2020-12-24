<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 10/11/19
 * Time: 10:12
 */
// src/Controller/BlogController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;
use App\Services\Anael;



class TranslateController extends AbstractController
{


    /**
     * @Route("/translate", name="translate")
     */
    public function index(TranslatorInterface $translator, Request $request)
    {
        dump($translator->getLocale());
        $translated = $translator->trans('Symfony is great');
        dump($translated);
        $translator->setLocale('fr');
        dump($translator->getLocale());
        $translated = $translator->trans('Symfony is great');
        dump($translated);


        $name = 'apple';
        $lastname = 'ananase';

        $translated = $translator->trans('Hello '.$name);

        dump($translated);

        $translated = $translator->trans(
            'Hello %name% %lastname%',
            array('%name%' => $name, '%lastname%' => $lastname)
        );
        dump($translated);

        $translated =  $translator->transChoice(
            'There is one apple|There are %count% apples',
            1
        );

        dump($translated);

        // Standard Regles
        $translated = $translator->transChoice(
            'Hurry up %name%! There is %count% apple left.|There are %count% apples left.',
            10,
            // no need to include %count% here; Symfony does that for you
            array('%name%' => 'Amine')
        );

        dump($translated);

        // Regle Mathematic
        dump('Regle Math');
        $translated = $translator->transChoice(
            '{0} There are no apples|{1} There is one apple|]1,19] There are %count% apples|[20,Inf[ There are many apples',
            20,
            // no need to include %count% here; Symfony does that for you
            array('%name%' => 'Amine')
        );
        dump($translated);

        // Mixtes Regles => if the count is not matched by a specific interval, ths standard rules take effect after removing the explicit rules
        dump('Regle Mixte');
        $translated = $translator->transChoice(
            '{0,22,23} There are no apples|[20,+Inf[ There are many apples|There is one apple|a_few: There are %count% apples',
            19
        );
        dump($translated);


        $catalogue = $translator->getCatalogue('fr_FR');
        $messages = $catalogue->all();
        while ($catalogue = $catalogue->getFallbackCatalogue()) {
            $messages = array_replace_recursive($catalogue->all(), $messages);
        }
        dump($messages);

        die;
    }

    /**
     * @Route("/translate-twig", name="translate-twig")
     */
    public function index2(TranslatorInterface $translator, Request $request)
    {
        dump($request->getLocale());
        dump($translator->getLocale());

        $data = [
            'first' => 0,
            'first-page' => 1
        ];

        $response = $this->render('translate/index.html.twig', [
            'name' => 'Amine',
            'count' => 10,
            'percent' => 10,
            'data' => $data
        ]);
        return $response;
    }


}