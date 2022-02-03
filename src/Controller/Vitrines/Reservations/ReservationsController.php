<?php


namespace App\Controller\Vitrines\Reservations;


use App\Entity\Actes\ActesCategories;
use App\Repository\Actes\ActesCategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("booking")
 * Class ReservationsController
 * @package App\Controller\Vitrines\Reservations
 * @author jaures kano <ruddyjaures@gmail.com>
 */
class ReservationsController extends AbstractController
{

    /**
     * @Route("/", name="booking_index")
     * @Route("/{id}/{slug}", name="booking_categorie_index")
     * @param ActesCategories|null $actesCategories
     * @param ActesCategoriesRepository $actesCategoriesRepository
     * @param string|null $slug
     * @return Response
     */
    public function indexReservation(?ActesCategories $actesCategories,
                                     ActesCategoriesRepository $actesCategoriesRepository,
                                     ?string $slug): Response
    {
        $categorie = $actesCategories ?? $actesCategoriesRepository->findOneBy([], ['designation' => 'ASC']);

        return $this->render('vitrine/reservations/reservations_index.html.twig', [
            'current' => 'booking',
            'categorie' => $categorie
        ]);
    }

}