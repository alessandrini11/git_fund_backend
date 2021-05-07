<?php

namespace App\Controller\admin;

use App\Entity\Adherent;
use App\Repository\AdherentRepository;
use App\Repository\DateRepository;
use App\Repository\DepenseRepository;
use App\Repository\DepotRepository;
use App\Repository\FiliereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(DateRepository $dateRepository,DepotRepository $depotRepository,DepenseRepository $depenseRepository,FiliereRepository $filiereRepository,AdherentRepository $adherentRepository): Response
    {
        $depots = $depotRepository->findAll();
        $adherents = $adherentRepository->findAll();
        $filieres = $filiereRepository->findAll();
        $filiereNom = [];
        $filiereCount = [];
        $depenses = $depenseRepository->findAll();
        $dates = $dateRepository->findBy(array(),array('date' => 'ASC'));
        $dateDepot = [];
        $dateCount = [];
        $depotSomme = [];
        foreach ($depots as $depot){
            $depotSomme[] = $depot->getSomme();
        }
        foreach ($dates as $date){
            $dateDepot[] = $date->getDate()->format('M');
            $dateCount[] = count($date->getDepots());
        }
        foreach ($filieres as $filiere){
            $filiereCount[] = count($filiere->getAdherents());
            $filiereNom[] = $filiere->getNom();
        }
        return $this->render('admin/index.html.twig', [
            'adhrents' => $adherents,
            'depenses' => $depenses,
            'depots' => $depots,
            'depotsDate' => json_encode($dateDepot),
            'depotsSomme' => json_encode($depotSomme),
            'filiereCount' =>json_encode($filiereCount),
            'filiereNom' => json_encode($filiereNom)
        ]);
    }


}
