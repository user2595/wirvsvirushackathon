<?php

namespace App\Controller;

use App\Entity\PreExistingCondition;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\ORM\EntityManagerInterface;

use App\Form\PreExistingConditionType;


class PreExistingConditionController extends AbstractController
{
    /**
     * @Route("/preExistingCondition/new", name="preExistingCondition_new")
     */
    public function formCreatePreExistingCondition(Request $request): Response {
        $entityManager = $this->getDoctrine()->getManager();

        $preExistingCondition = new PreExistingCondition();

        // FORM
        $form = $this->createForm(PreExistingConditionType::class, $preExistingCondition);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
                $preExistingCondition = $form->getData();

                // these should be saved to the database later!
                $entityManager->persist($preExistingCondition);

                // actually execute query
                $entityManager->flush();

                // redirecting to a page that new shows the new patient.
                return $this->redirectToRoute('preExistingCondition_new', []);
        }
                
        return $this->render('pre_existing_condition/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
