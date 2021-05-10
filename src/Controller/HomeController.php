<?php

namespace App\Controller;

use App\Entity\Adherent;
use App\Entity\AdherentFiltre;
use App\Form\AdherentFiltreType;
use App\Repository\AdherentRepository;
use App\Repository\DepenseRepository;
use App\Repository\DepotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function home(DepotRepository $depotRepository, DepenseRepository $depenseRepository): Response
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
    public function adherents(Request $request,AdherentRepository $adherentRepository): Response
    {
        $filtre = new AdherentFiltre();
        $form = $this->createForm(AdherentFiltreType::class,$filtre);
        $form->handleRequest($request);

        return $this->render('home/adherents.html.twig',[
            'adherents' => $adherentRepository->findBy(array(),array(
                'nom' => 'ASC'
            )),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/depots/{page}", name="depots_public", requirements={"page" : "\d+"})
     */
    public function depots($page = 1,DepotRepository $depotRepository): Response
    {
        $limite = 8;
        $debut = $page * $limite - $limite;
        $total = count($depotRepository->findAll());
        $pages = ceil($total / $limite);
        return $this->render('home/depots.html.twig',[
            'depots' => $depotRepository->findBy(array(),array(
                'created_at' => 'DESC',
                ),$limite,$debut),
            'pages' => $pages,
            'page' =>$page,
        ]);
    }

    /**
     * @Route("/depenses/{page}", name="depenses_public", requirements={"page":"\d+"})
     */
    public function depenses($page = 1,DepenseRepository $depenseRepository): Response
    {
        $limite = 8;
        $debut = $page * $limite - $limite;
        $total = count($depenseRepository->findAll());
        $pages = ceil($total / $limite);
        return $this->render('home/depenses.html.twig',[
            'depenses' => $depenseRepository->findBy(array(),array(
                'created' => 'DESC'
            ),$limite,$debut),
            'pages' => $pages,
            'page' =>$page,
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
