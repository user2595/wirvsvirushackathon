<?php

namespace App\Controller;

use App\Entity\Symptom;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\ORM\EntityManagerInterface;

use App\Form\SymptomType;


class SymptomController extends AbstractController
{
    /**
     * @Route("/symptom/new", name="symptom_new")
     */
    public function formCreateSymptom(Request $request): Response {
        $entityManager = $this->getDoctrine()->getManager();

        $symptom = new Symptom();

        // FORM
        $form = $this->createForm(SymptomType::class, $symptom);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
                $symptom = $form->getData();

                // these should be saved to the database later!
                $entityManager->persist($symptom);

                // actually execute query
                $entityManager->flush();

                // redirecting to a page that new shows the new patient.
                return $this->redirectToRoute('symptom_new', []);
        }
                
        return $this->render('symptom/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/symptom/list", name="symptom_list")
     */
    public function createSymptomList(): Response {
        $symptoms = $this->getDoctrine()->getRepository(Symptom::class)->findAllOrderedByName();

        return $this->render('symptom/list.html.twig', [
            'symptoms' => $symptoms,
        ]);
    }

}
