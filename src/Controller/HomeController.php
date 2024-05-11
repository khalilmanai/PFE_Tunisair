<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'HomePage')]
    public function index(): Response
    {
        // Redirect to the registration route
        return $this->render("homePage.html.twig");
    }
}
