<?php


namespace App\Controller\Vitrines\Reservations;


use App\Entity\Reservations\Reservations;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ConfirmReservationController
 * @author jaures kano <ruddyjaures@gmail.com>
 * @package App\Controller\Vitrines\Reservations
 */
class ConfirmReservationController extends AbstractController
{

    /**
     * @Route("/booking/active/{id}", name="app_booking_active")
     * @param Reservations $reservation
     * @return Response
     */
    public function indexConfirm(Reservations $reservation): Response
    {
        $em = $this->getDoctrine()->getManager();
        $message = 'Votre reservation à bien été activé, les administrateurs vous contacterons pour plus de precisions';
        $img = 'images/mail/mail_send.svg';

        if ($reservation->getStatut() === 1) {
            $reservation->setStatut(2);
            $reservation->setUpdatedAt(new DateTime());
            $em->persist($reservation);
            $em->flush();
        } else {
            $message = 'Votre reservation à été déjà prie en compte';
            $img = 'images/reviews/reviewed_docs.svg';
        }


        return $this->render('vitrine/reservations/reservation_confirmation.html.twig', [
            'message' => $message,
            'img' => $img
        ]);
    }

}