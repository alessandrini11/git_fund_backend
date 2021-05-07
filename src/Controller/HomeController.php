<?php

namespace App\Controller;

use App\Entity\Adherent;
use App\Repository\AdherentRepository;
use App\Repository\DepenseRepository;
use App\Repository\DepotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(DepotRepository $depotRepository, DepenseRepository $depenseRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'depots' => $depotRepository->findAll(),
            'depenses' => $depenseRepository->findAll(),
            'depotslimites' => $depotRepository->findBy(array(),array(
                'created_at' => 'DESC',
                ),5),
            'depenseslimites' => $depenseRepository->findBy(array(),array(
                'id' => 'DESC'
            ),5)
        ]);
    }

    /**
     * @Route("/adherents", name="adherent_public")
     */
    public function adherents(AdherentRepository $adherentRepository): Response
    {
        return $this->render('home/adherents.html.twig',[
            'adherents' => $adherentRepository->findBy(array(),array(
                'nom' => 'ASC'
            ))
        ]);
    }

    /**
     * @Route("/depots", name="depots_public")
     */
    public function depots(DepotRepository $depotRepository): Response
    {
        return $this->render('home/depots.html.twig',[
            'depots' => $depotRepository->findBy(array(),array(
                'created_at' => 'DESC',
                )),
        ]);
    }

    /**
     * @Route("/depenses", name="depenses_public")
     */
    public function depenses(DepenseRepository $depenseRepository): Response
    {
        return $this->render('home/depenses.html.twig',[
            'depenses' => $depenseRepository->findBy(array(),array(
                'created' => 'DESC'
            ))
        ]);
    }

    /**
     * @Route("/adherents/{id}", name="profile_public", methods={"GET"},requirements={"id"="\d+"})
     */
    public function profile(Adherent $adherent): Response
    {

        return $this->render('home/profile.html.twig',[
            'adherent' => $adherent
        ]);
    }
}
