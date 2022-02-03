<?php


namespace App\Controller\Admin\GestionsReservations;


use App\Entity\Reservations\Reservations;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/reservations")
 * Class GestionsReservationsController
 * @package App\Controller\Admin\GestionsReservations
 * @author jaures kano <ruddyjaures@gmail.com>
 */
class GestionsReservationsController extends AbstractController
{

    /**
     * @Route("/{id}", name="admin_reservations_index")
     * @param Reservations $reservation
     * @return Response
     */
    public function indexReservation(Reservations $reservation): Response
    {

        return $this->render('admins/dashboard/gestions_reservations/gestions_reservations_index.html.twig', [
            'reservation' => $reservation
        ]);
    }
}