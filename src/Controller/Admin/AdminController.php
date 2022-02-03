<?php 
namespace App\Controller\Admin;

use App\Repository\Reservations\ReservationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 * @package App\Controller\Admin
 * @author Yves EKANGA <yves.ekanga27@gmail.com>
 */
class AdminController extends AbstractController {

    /**
     * @Route("/", name="admin_index")
     * @param ReservationsRepository $reservationsRepository
     * @return Response
     */
    public function index(ReservationsRepository $reservationsRepository): Response
    {
        $reservations = $reservationsRepository->findAll();
        $attente = 0;
        $gerer = 0;
        $valider = 0;

        foreach ($reservations as $reservation){
            $reservation->getStatut() === 2 ? $attente++ : null;
            $reservation->getStatut() === 3 ? $valider++ : null;
            $reservation->getStatut() === 4 ? $gerer++ : null;
        }

        return $this->render('admins/dashboard/dashboard_index.html.twig', [
            'reservations' => $reservations,
            'nombre' => count($reservations),
            'attente' => $attente,
            'gerer' => $gerer,
            'valider' => $valider
        ]);
    }
}