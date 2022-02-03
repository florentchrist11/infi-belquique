<?php


namespace App\Controller\Admin\Horaires;


use App\Entity\Horaires\HorairesDisponibilite;
use App\Form\Horaires\HorairesDisponibiliteType;
use App\Repository\Horaires\HorairesDisponibiliteRepository;
use App\Repository\Horaires\HorairesJoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HorairesController
 * @author jaures kano <ruddyjaures@gmail.com>
 * @package App\Controller\Admin\Horaires
 */
class HorairesController extends AbstractController
{

    /**
     * @Route("admin/horaires/", name="admin_horaires_index")
     * @Route("admin/horaires/{jour}", name="admin_horaires_set")
     * @Route("admin/horaires/{id}/{jour}", name="admin_horaires_edit")
     * @param HorairesDisponibilite|null $horairesDisponibilite
     * @param int|null $jour
     * @param HorairesJoursRepository $joursRepository
     * @param HorairesDisponibiliteRepository $disponibiliteRepository
     * @param Request $request
     * @return Response
     */
    public function indexHoraires(?HorairesDisponibilite $horairesDisponibilite,
                                  ?int $jour, HorairesJoursRepository $joursRepository,
                                  HorairesDisponibiliteRepository $disponibiliteRepository,
                                  Request $request): Response
    {
        $selectJour = $jour ?? $request->get('jour') ??
            $joursRepository->findOneBy([], ['id' => 'ASC'])->getId() ?? 1;
        $em = $this->getDoctrine()->getManager();
        $horaire = $horairesDisponibilite ?? new HorairesDisponibilite();
        $form = $this->createForm(HorairesDisponibiliteType::class, $horaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $horairesDisponibilite === null ? $horaire->setIsActive(true) : null;
            $em->persist($horaire);
            $em->flush();
            return $this->redirectToRoute('admin_horaires_index');
        }

        return $this->render('admins/horaires/horaires_index.html.twig', [
            'horaires' => $disponibiliteRepository->findBy(['jour' => $selectJour]),
            'jours' => $joursRepository->findAll(),
            'selectJour' => $selectJour,
            'form_horaires' => $form->createView()
        ]);
    }

    /**
     * @Route("admin/horaires/delete/{id}/{jour}", name="admin_horaires_delete")
     * @param HorairesDisponibilite $horairesDisponibilite
     * @param int $jour
     * @return RedirectResponse
     */
     public function indexDeleteHoraires(HorairesDisponibilite $horairesDisponibilite, int $jour): RedirectResponse
     {
        $em = $this->getDoctrine()->getManager();
        $em->remove($horairesDisponibilite);
        $em->flush();
         return $this->redirectToRoute('admin_horaires_set', ['jour' => $jour]);
     }

    /**
     * @Route("admin/horaires/action/{id}/{jour}", name="admin_horaires_action")
     * @param HorairesDisponibilite $horairesDisponibilite
     * @param int|null $jour
     * @return RedirectResponse
     */
    public function indexActionHoraires(HorairesDisponibilite $horairesDisponibilite, ?int $jour): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $horairesDisponibilite->setIsActive(!$horairesDisponibilite->getIsActive());
        $em->persist($horairesDisponibilite);
        $em->flush();
        return $this->redirectToRoute('admin_horaires_set', ['jour' => $jour]);
    }
}