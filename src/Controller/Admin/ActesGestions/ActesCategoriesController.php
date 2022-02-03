<?php


namespace App\Controller\Admin\ActesGestions;


use App\Entity\Actes\ActesCategories;
use App\Form\Actes\ActesCategoriesType;
use App\Repository\Actes\ActesCategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ActesCategoriesController
 * @author jaures kano <ruddyjaures@gmail.com>
 * @package App\Controller\Admin\ActesGestions
 */
class ActesCategoriesController extends AbstractController
{

    /**
     * @Route("admins/gestions/actes/categorie", name="admin_gestion_categorie_index")
     * @Route("admins/gestions/actes/categorie/edit/{id}", name="admin_gestion_categorie_edit")
     * @param ActesCategories|null $actesCategories
     * @param ActesCategoriesRepository $repository
     * @param Request $request
     * @return Response
     */
    public function actesCategoriesIndex(?ActesCategories $actesCategories,
                                         ActesCategoriesRepository $repository,
                                         Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = $actesCategories ?? new ActesCategories();
        $form = $this->createForm(ActesCategoriesType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute('admin_gestion_categorie_index');
        }

        return $this->render('admins/actes_gestions/actes_categories.html.twig',[
            'categories' => $repository->findAll(),
            'acte_form' => $form->createView()
        ]);
    }


    /**
     * @Route("admins/gestions/actes/categorie/delete/{id}", name="admin_gestion_categorie_delete")
     * @param ActesCategories $actesCategorie
     * @return RedirectResponse
     */
    public function indexDeleteActeCategories(ActesCategories $actesCategorie): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($actesCategorie);
        $em->flush();
        return $this->redirectToRoute('admin_gestion_categorie_index');
    }

}