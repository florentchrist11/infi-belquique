<?php

namespace App\Controller\Vitrines\Prestations;

use App\Repository\Actes\ActesCategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class HygieneController
 * @package App\Controller\Vitrines\Prestations
 * @author Maxime <elessamaxime@icloud.com> | jaures kano <ruddyjaures@gmail.com>
 */
class HygieneController extends AbstractController
{
    /**
     * @Route("/hygiene", name="app_hygiene_index")
     * @param ActesCategoriesRepository $repository
     * @return Response
     * @author Maxime <elessamaxime@icloud.com> | jaures kano <ruddyjaures@gmail.com>
     */
    public function index(ActesCategoriesRepository $repository): Response
    {
        return $this->render('vitrine/prestations/hygiene/index.html.twig', [
            'current' => 'Hygiene',
            'image' => '/images/reviews/toilette.jpg',
            'categorie' => $repository->findOneBy(['id' => 3])
        ]);
    }
}
