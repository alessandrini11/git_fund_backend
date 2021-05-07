<?php

namespace App\Controller\admin;

use App\Entity\Depot;
use App\Form\DepotType;
use App\Repository\DepotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/depot")
 */
class DepotController extends AbstractController
{
    /**
     * @Route("/", name="depot_index", methods={"GET","POST"})
     */
    public function index(DepotRepository $depotRepository, Request $request): Response
    {
        $depot = new Depot();
        $form = $this->createForm(DepotType::class, $depot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($depot);
            $entityManager->flush();

            $this->addFlash(
                'success',
                "Le dépot de ".$depot->getAdherents()->getNom()." a été éffectué"
            );
            return $this->redirectToRoute('depot_index');
        }
        return $this->render('admin/depot/index.html.twig', [
            'depots' => $depotRepository->findBy(array(),array('created_at' => 'DESC')),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="depot_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Depot $depot): Response
    {
        $form = $this->createForm(DepotType::class, $depot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                "Le dépot de ".$depot->getAdherents()->getNom()." a été modifié"
            );
            return $this->redirectToRoute('depot_index');
        }

        return $this->render('admin/depot/edit.html.twig', [
            'depot' => $depot,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="depot_delete", methods={"POST"})
     */
    public function delete(Request $request, Depot $depot): Response
    {
        if ($this->isCsrfTokenValid('delete'.$depot->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($depot);
            $entityManager->flush();

            $this->addFlash(
                'supprimer',
                "Le dépot de ".$depot->getAdherents()->getNom()." a été supprimé"
            );
        }

        return $this->redirectToRoute('depot_index');
    }
}
