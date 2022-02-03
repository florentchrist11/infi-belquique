<?php


namespace App\Controller\Admin\GestionsReservations;


use App\Repository\Reservations\ReservationsHorairesRepository;
use App\Repository\Reservations\ReservationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller\Admin\GestionsReservations/ReponsesReservationController
 * @author Jaures Kano <ruddyjaures@gmail.com>
 */
class ReponsesReservationController extends AbstractController
{

    /**
     * @Route("api/response/booking", name="api_response_booking")
     * @param Request $request
     * @param ReservationsRepository $reservationsRepository
     * @param ReservationsHorairesRepository $reservationsHorairesRepository
     * @return JsonResponse
     * @throws \JsonException
     */
    public function indexReponse(Request $request, ReservationsRepository $reservationsRepository,
                                 ReservationsHorairesRepository $reservationsHorairesRepository): JsonResponse
    {
        $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $reservation = $reservationsRepository->find($content['id']);
        $lockHour = [];

        if ($reservation !== null && $reservation->getStatut() === 2) {
            $em = $this->getDoctrine()->getManager();
            $horairesReservation = $content['reservation'];
            foreach ($horairesReservation as $h) {
                $horaire = $reservationsHorairesRepository->find($h['id']);
                if ($horaire) {
                    $orderDate = null;
                    $ifFree = $reservationsHorairesRepository->findFreeHour($horaire);

                    array_key_exists('otherDate', $h) && $h['otherDate'] !== null ?
                        $orderDate = new \DateTime($h['otherDate']) : null;
                    count($ifFree) > 0 ? $lockHour += $ifFree : null;
                    $horaire->setStatut((bool)$h['reponse']);
                    $em->persist($horaire);
                }
            }

            if (count($lockHour) === 0) {
                $reservation->setStatut(3);
                $em->persist($reservation);
                $em->flush();

                return $this->json([
                    'message' => 'La reservation a bien ete gerer et l\'email a biene ete envoyé',
                    'isOk' => true
                ], 200);
            }
            return $this->json([
                'message' => 'Des horaire coicide',
                'lockHour' => $lockHour,
                'isOk' => false
            ], 400, [], ['groups' => 'read:horaires']);
        }

        return $this->json([
            'message' => 'La reservation n\'as pas encore été valider',
            'isOk' => false
        ], 400);
    }

}