<?php


namespace App\Controller\Vitrines\Reservations;


use App\Entity\Patients\PatientsEnregistrer;
use App\Entity\Reservations\Reservations;
use App\Entity\Reservations\ReservationsHoraires;
use App\Notifications\ReservationsNotifications;
use App\Repository\Horaires\HorairesDisponibiliteRepository;
use App\Repository\Systemes\BelgiqueCodePostauxRepository;
use DateTime;
use DateTimeImmutable;
use JsonException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("booking/save")
 * Class EnregistrementReservationController
 * @package App\Controller\Vitrines\Reservations
 * @author jaures kano <ruddyjaures@gmail.com>
 */
class EnregistrementReservationController extends AbstractController
{

    /**
     * @Route("/", name="api_booking_save")
     * @param Request $request
     * @param ReservationsNotifications $notifications
     * @param BelgiqueCodePostauxRepository $belgiqueCodePostauxRepository
     * @param HorairesDisponibiliteRepository $disponibiliteRepository
     * @return Response
     * @throws JsonException
     */
    public function index(Request $request,
                          ReservationsNotifications $notifications,
                          BelgiqueCodePostauxRepository $belgiqueCodePostauxRepository,
                          HorairesDisponibiliteRepository $disponibiliteRepository): Response
    {
        $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $em = $this->getDoctrine()->getManager();
        $data = $content['data'];
        $choices = $content['choice'];
        $patient = new PatientsEnregistrer();
        $patient->setEmail($data['email']);
        $patient->setPrenom($data['prenom']);
        $patient->setRue($data['rue']);
        $patient->setNom($data['nom']);
        $patient->setNumeroPorte($data['numeroPorte']);
        $patient->setContact($data['contact']);
        $patient->setCodePostal($belgiqueCodePostauxRepository->find($content['code']));
        $em->persist($patient);
        //$em->flush();

        $reservation = new Reservations();
        $reservation->setStatut(1);
        $reservation->setCreatedAt(new DateTime());
        $reservation->setPatientsEnregistrer($patient);
        $reservation->setPrestations($content['acte']);
        $em->persist($reservation);
        //$em->flush();


        foreach ($choices as $c) {
            $time = new DateTimeImmutable(substr($c, 0, 16));
            $timeE = substr($c, 0, 11) . substr($c, 19, 25);
            $timeEnd = new DateTimeImmutable($timeE);
            $horaireDispo = $disponibiliteRepository->findValid((int)$time->format('w'), $time);
            $reservationHoraire = new ReservationsHoraires();
            $reservationHoraire->setStartAt($time);
            $reservationHoraire->setFinishAt($timeEnd);
            $reservationHoraire->setDate($time);
            $reservationHoraire->setReservation($reservation);
            if (count($horaireDispo) > 0) {
                $reservationHoraire->setHorairesDisponibilites($horaireDispo[0]);
                $em->persist($reservationHoraire);
            }
        }
        $em->flush();

        $notifications->sendMail($reservation);
        return $this->json([
            'isOk' => true,
            'message' => [
                'title' => 'Enregistrement réussi et email envoyer à l\'adresse ' . $patient->getEmail(),
                'desc' => 'Consulter votre boite email pour valider votre réservaion, NB: vous disposez de 6h pour activer
                 votre réservation dans le cas contraire nous serons oubliger d\'annuler  votre réservation'
            ]
        ]);
    }
}