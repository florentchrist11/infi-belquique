<?php


namespace App\Controller\Vitrines\Reservations;


use App\Entity\Reservations\Reservations;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DismissReservationController
 * @author jaures kano <ruddyjaures@gmail.com>
 * @package App\Controller\Vitrines\Reservations
 */
class DismissReservationController extends AbstractController
{

    /**
     * @Route("/booking/dismiss/{id}", name="app_booking_dismiss")
     * @param Reservations $reservation
     * @return Response
     */
    public function indexDissmiss(Reservations $reservation): Response
    {
        $em = $this->getDoctrine()->getManager();
        $message = 'Votre reservation à bien été supprimé';
        $img = 'images/mail/mail_send.svg';


        if ($reservation->getStatut() === 1) {
            foreach ($reservation->getReservationsHoraires() as $horaire) {
                $em->remove($horaire);
            }
            $em->remove($reservation);
            $em->flush();
        } else {
            $message = 'Votre reservation à été déjà prie en compte';
            $img = 'images/reviews/reviewed_docs.svg';
        }

        return $this->render('vitrine/reservations/reservation_delete.html.twig', [
            'message' => $message,
            'img' => $img
        ]);
    }

}