<?php

namespace App\Controller\Vitrines;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AproposController extends AbstractController
{
    /**
     * @Route("/apropos", name="apropos")
     * @author Maxime <elessamaxime@icloud.com>
     */
    public function index(): Response
    {
        return $this->render('vitrine/apropos/index.html.twig', [
            'current' => 'apropos',
        ]);
    }
}
