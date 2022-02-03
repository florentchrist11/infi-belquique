<?php


namespace App\Controller\Admin\ActesGestions;


use App\Entity\Actes\ActesPrestations;
use App\Form\Actes\ActesPrestationsType;
use App\Repository\Actes\ActesPrestationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ActesController
 * @author jaures kano <ruddyjaures@gmail.com>
 * @package App\Controller\Admin\ActesGestions
 */
class ActesController extends AbstractController
{

    /**
     * @Route("admin/gestions/actes", name="admin_actes_index")
     * @Route("admin/gestions/actes/edit/{id}", name="admin_actes_edit")
     * @param ActesPrestations|null $prestations
     * @param ActesPrestationsRepository $prestationsRepository
     * @param Request $request
     * @return Response
     */
    public function indexActes(?ActesPrestations $prestations,
                               ActesPrestationsRepository $prestationsRepository,
                               Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $prestation = $prestations ?? new ActesPrestations();
        $form = $this->createForm(ActesPrestationsType::class, $prestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($prestation);
            $em->flush();
            return $this->redirectToRoute('admin_actes_index');
        }

        return $this->render('admins/actes_gestions/actes_index.html.twig', [
            'prestations' => $prestationsRepository->findAll(),
            'form_prestations' => $form->createView()
        ]);
    }


    /**
     * @Route("admin/gestions/actes/delete/{id}", name="admin_actes_delete")
     * @param ActesPrestations $prestations
     * @return RedirectResponse
     */
    public function indexDeleteActe(ActesPrestations $prestations): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($prestations);
        $em->flush();
        return $this->redirectToRoute('admin_actes_index');
    }

}