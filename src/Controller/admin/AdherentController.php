<?php

namespace App\Controller\admin;

use App\Entity\Adherent;
use App\Form\AdherentType;
use App\Repository\AdherentRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/adherent")
 */
class AdherentController extends AbstractController
{
    /**
     *
     * @Route("/", name="adherent_index", methods={"GET","POST"})
     *
     */
    public function index(AdherentRepository $adherentRepository,Request $request): Response
    {
        $adherent = new Adherent();
        $form = $this->createForm(AdherentType::class, $adherent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($adherent);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'L\'adherent '.$adherent->getNom().' a été enregistré '
            );
            return $this->redirectToRoute('adherent_index');
        }
        return $this->render('admin/adherent/index.html.twig', [
            'adherents' => $adherentRepository->findBy(array(),array('nom' => 'ASC')),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/new", name="adherent_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $adherent = new Adherent();
        $form = $this->createForm(AdherentType::class, $adherent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($adherent);
            $entityManager->flush();

            return $this->redirectToRoute('adherent_index');
        }

        return $this->render('adherent/new.html.twig', [
            'adherent' => $adherent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="adherent_show", methods={"GET"},requirements={"id"="\d+"})
     */
    public function show(Adherent $adherent): Response
    {
        return $this->render('/admin/adherent/show.html.twig', [
            'adherent' => $adherent,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="adherent_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Adherent $adherent): Response
    {
        $form = $this->createForm(AdherentType::class, $adherent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                'L\'adherent '.$adherent->getNom().' a été modifié '
            );
            return $this->redirectToRoute('adherent_index');
        }

        return $this->render('admin/adherent/edit.html.twig', [
            'adherent' => $adherent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="adherent_delete", methods={"POST"})
     */
    public function delete(Request $request, Adherent $adherent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adherent->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($adherent);
            $entityManager->flush();

            $this->addFlash(
                'supprimer',
                'L\'adherent '.$adherent->getNom().' a été supprimé '
            );
        }

        return $this->redirectToRoute('adherent_index');
    }
}
