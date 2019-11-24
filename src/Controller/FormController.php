<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 06/11/19
 * Time: 15:27
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;

use App\Form\ArticleType;
use App\Entity\Article;

use App\Services\FileUploader;

class FormController extends AbstractController
{

    /**
     * @Route("/form/new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request, FileUploader $fileUploader)
    {
        $article = new Article();
        $article->setTitle('Hello World');
        $article->setContent('Un très court article.');
        $article->setAuthor('Zozor');
        $article->setDate(new \DateTime());
        $article->setCreated(new \DateTime());

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $brochureFile */
            $brochureFile = $form['brochure']->getData();

            if ($brochureFile) {

                // Updates the brochureFilename property to store the PDF file name
                $article->setBrochureFilename($fileUploader->upload($brochureFile));
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            $this->addFlash(
                'notice',
                'Your changes were saved!'
            );
            // $this->addFlash() is equivalent to $request->getSession()->getFlashBag()->add()
        } else {
            dump('not valid or not submitted ');
        }

        return $this->render('default/new.html.twig', array(
            'articleForm' => $form->createView(),
        ));

    }

    /**
     * @Route("/form/edit/{id<\d+>}")
     */
    public function edit(Request $request, Article $article)
    {

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // va effectuer la requête d'UPDATE en base de données
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('default/new.html.twig', array(
            'articleForm' => $form->createView(),
        ));
    }
}