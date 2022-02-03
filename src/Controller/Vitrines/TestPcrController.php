<?php

namespace App\Controller\Vitrines;

use App\Repository\Actes\ActesCategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestPcrController extends AbstractController
{
    /**
     * @Route("/campagnes/test_pcr", name="test_pcr")
     * @param ActesCategoriesRepository $repository
     * @return Response
     * @author Maxime <elessamaxime@icloud.com>
     */
    public function index(ActesCategoriesRepository $repository): Response
    {
        return $this->render('vitrine/test_pcr/index.html.twig', [
            'current' => 'TestPcr',
            'categorie' => $repository->findOneBy(['id' => 6]),
            'image' => '/images/reviews/test_pcr.svg'
        ]);
    }
}
