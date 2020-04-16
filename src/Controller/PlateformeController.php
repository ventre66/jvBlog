<?php

namespace App\Controller;

use App\Entity\Plateforme;
use App\Form\PlateformeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PlateformeController extends AbstractController
{
    /**
     * @Route("/plateforme", name="plateforme")
     */
    public function index()
    {
        $plateforme = $this->getDoctrine()->getRepository(Plateforme::class)->findAll();

        return $this->render('plateforme/index.html.twig', [
            "plateformes" => $plateforme
        ]);
    }

    /**
     * @Route("/plateforme/creer", name="plateforme_creer")
     */
    public function creer(Request $request)
    {
        $plateforme = new Plateforme();
        $form = $this->createForm(PlateformeType::class, $plateforme);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($plateforme);
            $em->flush();

            return $this->redirectToRoute('plateforme');
        }

        return $this->render('plateforme/creer.html.twig', [
            "form" => $form->createView(),
            "plateforme" => $plateforme
        ]);
    }

    /**
     * @param Plateforme $plateforme
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/plateforme/editer/{slug}", name="plateforme_editer")
     */
    public function editer(Plateforme $plateforme, Request $request)
    {
        $form = $this->createForm(PlateformeType::class, $plateforme);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($plateforme);
            $em->flush();

            return $this->redirectToRoute('plateforme');
        }

        return $this->render('plateforme/creer.html.twig', [
            "form" => $form->createView(),
            "plateforme" => $plateforme
        ]);
    }
}
