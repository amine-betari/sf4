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
use App\Entity\Task;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Services\FileUploader;

class FormController extends AbstractController
{

    /**
     * @Route("/form/new", name="article")
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

        }

        // Twig
        $format = $request->getRequestFormat();
        dump($format);

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
            $article->setUpdated(new \DateTime());
            // va effectuer la requête d'UPDATE en base de données
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('default/new.html.twig', array(
            'articleForm' => $form->createView(),
        ));
    }

    /**
     * @Route("/form/task", name="task")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newTask(Request $request)
    {
        // creates a task and gives it some dummy data for this example
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
            ->add('task', null, array('label' => 'Nour', 'attr' => array('maxlength' => 4)))
            ->add('dueDate', DateType::class,  array('widget' => 'single_text'))
            ->add('agreeTerms', CheckboxType::class, array('mapped' => false))
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->setAction($this->generateUrl('task'))
            ->setMethod('GET')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            $task = $form->getData();
            dump($form->get('agreeTerms')->getData());
            dump($form->get('task')->getData());
            die;
            return $this->redirectToRoute('article');

        }

        return $this->render('forms/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }}