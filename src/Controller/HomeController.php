<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
        ]);
    }

    /**
     * @Route("/adherents", name="adherent_public")
     */
    public function adherents(): Response
    {
        return $this->render('home/adherents.html.twig');
    }

    /**
     * @Route("/depots", name="depots_public")
     */
    public function depots(): Response
    {
        return $this->render('home/depots.html.twig');
    }

    /**
     * @Route("/depenses", name="depenses_public")
     */
    public function depenses(): Response
    {
        return $this->render('home/depenses.html.twig');
    }

    /**
     * @Route("/profile", name="profile_public")
     */
    public function profile(): Response
    {
        return $this->render('home/profile.html.twig');
    }
}
