<?php

namespace App\Controller\Vitrines;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @author Maxime <elessamaxime@icloud.com>
     */
    public function index(): Response
    {

        return $this->render('vitrine/home/index.html.twig', [
            'current' => 'Home',
        ]);
    }
}
