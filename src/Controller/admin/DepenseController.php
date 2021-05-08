<?php

namespace App\Controller\admin;

use App\Entity\Depense;
use App\Form\DepenseType;
use App\Repository\DepenseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/depense")
 */
class DepenseController extends AbstractController
{
    /**
     * @Route("/{page}", name="depense_index", methods={"GET","POST"}, requirements={"page":"\d+"})
     */
    public function index($page = 1,DepenseRepository $depenseRepository,Request $request): Response
    {
        $limite = 8;
        $debut = $page * $limite - $limite;
        $total = count($depenseRepository->findAll());
        $pages = ceil($total / $limite);
        $depense = new Depense();
        $form = $this->createForm(DepenseType::class, $depense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($depense);
            $entityManager->flush();

            $this->addFlash(
                'success',
                "La dépense a été enregistrée"
            );
            return $this->redirectToRoute('depense_index');
        }
        return $this->render('admin/depense/index.html.twig', [
            'depenses' => $depenseRepository->findBy(array(),array('id' => 'DESC'),$limite,$debut),
            'form' => $form->createView(),
            'pages' => $pages,
            'page' =>$page,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="depense_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Depense $depense): Response
    {
        $form = $this->createForm(DepenseType::class, $depense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                "La dépense a été modifié"
            );
            return $this->redirectToRoute('depense_index');
        }

        return $this->render('admin/depense/edit.html.twig', [
            'depense' => $depense,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="depense_delete", methods={"POST"})
     */
    public function delete(Request $request, Depense $depense): Response
    {
        if ($this->isCsrfTokenValid('delete'.$depense->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($depense);
            $entityManager->flush();

            $this->addFlash(
                'delete',
                "La dépense a été annulée "
            );
        }

        return $this->redirectToRoute('depense_index');
    }
}
