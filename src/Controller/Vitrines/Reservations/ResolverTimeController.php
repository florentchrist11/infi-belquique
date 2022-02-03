<?php


namespace App\Controller\Vitrines\Reservations;


use App\Repository\Horaires\HorairesDisponibiliteRepository;
use DateTimeImmutable;
use Exception;
use JsonException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/build/request")
 * Class ResolverTimeController
 * @package App\Controller\Vitrines\Reservations
 * @author jaures kano <ruddyjaures@gmail.com>
 */
class ResolverTimeController extends AbstractController
{

    /**
     * @Route("/date", name="api_request_time")
     * @param Request $request
     * @param HorairesDisponibiliteRepository $disponibiliteRepository
     * @return Response
     * @throws JsonException
     * @throws Exception
     */
    public function indexResolver(Request $request,
                                  HorairesDisponibiliteRepository $disponibiliteRepository): Response
    {
        $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $days = $content['days'];
        $maxRow = 0;
        $dispo = [];

        foreach ($days as $day) {
            $dateImmutable = new DateTimeImmutable($day);
            $intWeek = (int)$dateImmutable->format('N');
            $disponibles = $disponibiliteRepository->findBy(['jour' => $intWeek]);
            $countDispo = count($disponibles);
            $countDispo > $maxRow ? $maxRow = $countDispo : null;
            foreach ($disponibles as $disponibilite) {
                $dispo[$day][] = $disponibilite->getStartAt()->format('H:i') . ' - ' .
                    $disponibilite->getFinishAt()->format('H:i');
            }
        }

        return $this->json([
            'dispo' => $dispo,
            'row' => $maxRow
        ]);
    }
}