<?php

namespace App\Controller;

use App\Entity\RiskFactor;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\ORM\EntityManagerInterface;

use App\Form\RiskFactorType;


class RiskFactorController extends AbstractController
{
    /**
     * @Route("/riskFactor/new", name="risk_factor_new")
     */
    public function formCreateRisk(Request $request): Response {
        $entityManager = $this->getDoctrine()->getManager();

        $risk = new RiskFactor();

        // FORM
        $form = $this->createForm(RiskFactorType::class, $risk);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
                $risk = $form->getData();

                // these should be saved to the database later!
                $entityManager->persist($risk);

                // actually execute query
                $entityManager->flush();

                // redirecting to a page that new shows the new patient.
                return $this->redirectToRoute('risk_factor_new', []);
        }
                
        return $this->render('risk_factor/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
