<?php

namespace App\Controller\Vitrines;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contact")
 * @package App\Controller\Vitrine\AdminContact
 * @author Yves EKANGA <yves.ekanga27@gmail.com>
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/", name="contact")
     */
    public function index(): Response
    {
        return $this->render('vitrine/contact/index.html.twig', [
            'current' => 'contact',
        ]);
    }
}
