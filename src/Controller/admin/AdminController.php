<?php

namespace App\Controller\admin;

use App\Entity\Adherent;
use App\Repository\AdherentRepository;
use App\Repository\DepenseRepository;
use App\Repository\DepotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(DepotRepository $depotRepository,DepenseRepository $depenseRepository,AdherentRepository $adherentRepository): Response
    {
        $adherents = $adherentRepository->findAll();
        $adherentsCount = [];
        $adherentsFiliere = [];
        $depenses = $depenseRepository->findAll();
        $depots = $depotRepository->findAll();
        $depotsSomme = [];
        $depotsDate = [];
        foreach ($depots as $depot){
            $depotsSomme[] = $depot->getSomme()->getNom();
            $depotsDate[] = $depot->getMonth();
        }
        return $this->render('admin/index.html.twig', [
            'adhrents' => $adherents,
            'depenses' => $depenses,
            'depots' => $depots
        ]);
    }


}
