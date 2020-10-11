<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 06/11/19
 * Time: 15:27
 */

namespace App\Controller;

use App\Form\CompanyType;
use App\Form\CustomerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;

use App\Form\ArticleType;
use App\Form\TaskType;
use App\Entity\Article;
use App\Entity\Task;
use App\Form\Type\ShippingType;
use App\Entity\Customer;
use App\Entity\Company;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\CallbackTransformer;

use App\Services\FileUploader;

class FormController extends AbstractController
{

    /**
     * @Route("/form/new",  name="article")
     * @Route("/form/new1", name="article1")
     * @Route("/form/new2", name="article2")
     * @Route("/form/new3", name="article3")
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

            dump($request->attributes);
            dump(get_class($request->files->get('article')['brochure']));
            die;

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
     //   dump($format);
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
     * @Route("/form/new",  name="article")
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

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            $task = $form->getData();
            dump($form->get('agreeTerms')->getData());
            dump($form->get('task')->getData());
            dump($form->get('tags')->getData());
            die;
            return $this->redirectToRoute('article');

        }

        return $this->render('forms/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }



        /**
         * @Route("/form/company", name="company")
         *
         * @param Request $request
         * @return \Symfony\Component\HttpFoundation\Response
         */
        public function jalil(Request $request)
        {
            // creates a task and gives it some dummy data for this example
            $company = new Company();

            $company->setName("BAS");
            $company->setWebsite("www.bas-consulting.fr");
            $company->setAddress("AGDAL HAY");
            $company->setCity("OUJDA");
            $company->setCountry("Maroc");
            $company->setZipcode("60000");

            $form = $this->createForm(CompanyType::class, $company);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                // $form->getData() holds the submitted values
                $company = $form->getData();
                dump($company);
                die;
                return $this->redirectToRoute('article');

            }

            return $this->render('forms/company.html.twig', array(
                'form' => $form->createView(),
            ));
        }


    /**
     * @Route("/form/customer", name="customer")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function akil(Request $request)
    {
        // creates a task and gives it some dummy data for this example
        $customer = new Customer();

        $customer->setFirstName("Amine");
        $customer->setLastName("BETARI");
        $customer->setAddress("AGDAL HAY");
        $customer->setCity("OUJDA");
        $customer->setCountry("Maroc");
        $customer->setZipcode("60000");

        $form = $this->createForm(CustomerType::class, $customer);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            $customer = $form->getData();
            dump($customer);
            die;
        }

        return $this->render('forms/customer.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}