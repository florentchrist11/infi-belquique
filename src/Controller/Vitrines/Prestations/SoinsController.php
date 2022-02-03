<?php


namespace App\Controller\Vitrines\Prestations;


use App\Repository\Actes\ActesCategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/soins")
 * Class SoinsController
 * @author jaures kano <ruddyjaures@gmail.com>
 * @package App\Controller\Vitrines
 */
class SoinsController extends AbstractController
{

    private ActesCategoriesRepository $repository;

    /**
     * SoinsController constructor.
     * @param ActesCategoriesRepository $repository
     */
    public function __construct(ActesCategoriesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/a-domiciles", name="app_soins_domiciles_index")
     * @return Response
     */
    public function indexSoins(): Response
    {

        return $this->render('vitrine/prestations/soins/domiciles/domiciles_index.html.twig', [
            'image' => '/images/reviews/soins_ad.jpg',
            'categorie' => $this->repository->findOneBy(['id' => 1])
        ]);
    }

    /**
     * @Route("/paleatifs", name="app_soins_palliatifs_index")
     * @return Response
     */
    public function indexSoinsPaleatifs(): Response
    {
        return $this->render('vitrine/prestations/soins/paliatifs/paliatifs_index.html.twig', [
            'image' => '/images/reviews/paliatifs.jpg',
            'categorie' => $this->repository->findOneBy(['id' => 2])
        ]);
    }

    /**
     * @Route("/infirmiers", name="app_soins_infirmiers_index")
     * @return Response
     */
    public function indexSoinsInfirmiers(): Response
    {
        return $this->render('vitrine/prestations/soins/infirmiers/infirmiers_index.html.twig', [
            'image' => '/images/reviews/infi.jpg',
            'categorie' => $this->repository->findOneBy(['id' => 4])
        ]);
    }

    /**
     * @Route("/visage-humain", name="app_soins_visage_humain_index")
     * @return Response
     */
    public function indexSoinsVisage(): Response
    {
        return $this->render('vitrine/prestations/soins/visages/visages_index.html.twig', [
            'image' => '/images/reviews/visage.jpg',
            'categorie' => $this->repository->findOneBy(['id' => 5])
        ]);
    }
}