<?php

namespace App\Controller;

use App\Entity\Application;
use App\Entity\Jobs;
use App\Form\ApplicationType;
use App\Repository\JobsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/offers', name: 'view_offer')]
    public function viewOffer(JobsRepository $jobsRepository): Response
    {
        $jobs = $jobsRepository->findAll(Jobs::class);

        return $this->render("user/viewOffer.html.twig", ["jobs" => $jobs]);
    }


    #[Route('/search', name: 'search_job')]
    public function search(Request $request, JobsRepository $jobsRepository): Response
    {
        $query = $request->query->get('query');

        $jobs = $jobsRepository->findByTitle($query);

        return $this->render('user/search.html.twig', [
            'query' => $query,
            'jobs' => $jobs,
        ]);
    }




    #[Route('/apply', name: 'apply')]

    public function apply(Request $request, EntityManagerInterface $entityManager): Response
    {
        $application = new Application();

        // Get current user
        $user = $this->getUser();

        // Check if user is not null
        if ($user !== null) {
            // Set user to the application
            $application->setUser($user);

            $form = $this->createForm(ApplicationType::class, $application);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                // Handle file uploads and other logic

                // Persist the application entity
                $entityManager->persist($application);
                $entityManager->flush();

                // Redirect to a success page
                return $this->redirectToRoute('application_success');
            }

            return $this->render('user/application/apply.html.twig', [
                'form' => $form->createView(),
            ]);
        } else {
            // Handle the case where the user is null
            // You may want to redirect the user to login or handle it according to your application flow
        }
    }


    #[Route('/application/success', name: 'application_success')]
    public function  applicationSuccess(): Response
    {

        return $this->render('user/application/application_success.html.twig');
    }




    #[Route('/interns/home', name: "intern_main")]
    public function internMain(UserRepository $userRepo): Response
    {
        $users = $userRepo->findAll();


        return $this->render('/user/intern_main.html.twig', ['users' => $users]);
    }
}
