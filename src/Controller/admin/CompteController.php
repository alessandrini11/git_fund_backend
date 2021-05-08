<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class CompteController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $utils): Response
    {
        $error = $utils->getLastAuthenticationError();
        $utilisateur = $utils->getLastUsername();
        return $this->render('admin/compte/index.html.twig', [
            'hasError' => $error !== null,
            'utilisateur' => $utilisateur
        ]);
    }

    /**
     * @Route("/deconnexion", name="deconnexion")
     * @return void
     */
    public function deconnexion()
    {

    }
}
