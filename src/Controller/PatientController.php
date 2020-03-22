<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Validator\Validator\ValidatorInterface;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

use App\Entity\Patient;
use App\Entity\Address;
use App\Entity\Symptom;
use App\Entity\PreExistingCondition;
use App\Entity\RiskFactor;

use App\Form\PatientType;

class PatientController extends AbstractController
{

    // NOTE(aurel): Dummy that basically never gets called and probably doesn't even work anymore.
    //              If you need a patient quickly call `localhost:8000/patient` and one will be created. Only
    //              use this if no fixtures are available.
    // TODO(aurel): Create fixtures!
    /**
     * @Route("/patient", name="create_patient")
     */
    public function staticCreatePatient(ValidatorInterface $validator): Response {
        $entityManager = $this->getDoctrine()->getManager();

        $patient = new Patient();
        $patient->setName('Max');
        $patient->setSurname('Mustermann');
        $patient->setBirthdate(new \DateTime("now"));
        $patient->setPhoneNr('0049 123 45678910');
        $patient->setEmail('max@mustermann.org');
        $patient->setNote(null);
        $patient->setAppointment(null);
        //$patient->setTest(null);

        // TODO(aurel): only create new address if it did not exist before
        $address = new Address();
        $address->setStreet('Muster Strasse');
        $address->setNr('1');
        $address->setCity('Musterstadt');
        $address->setZipCode('12345');
        $address->setCountry('Musterland');
        $address->addPatient($patient);

        $patient->setAddress($address);

        $symptom_coughing = new Symptom();
        $symptom_coughing->setName('Coughing');
        $symptom_coughing->setDescription('Medium to high coughing.');
        $symptom_coughing->setDegree(2);
        $symptom_coughing->setStartingDate(new \DateTime("now"));
        $symptom_coughing->addPatient($patient);
        $patient->addSymptom($symptom_coughing);

        //$patient->addPreExistingConditions(); // not pre-existing condition
        //$patient->addRiskFactor(); // no risk factors

        $errors = $validator->validate($patient);
        if(count($errors) > 0) {
            return new Response((string) $errors, 400);
        }

        // these should be saved to the database later!
        $entityManager->persist($address);
        $entityManager->persist($symptom_coughing);
        $entityManager->persist($patient);

        // actually execute query
        $entityManager->flush();

        // redirecting to a page that new shows the new patient.
        return $this->redirectToRoute('patient_show', [
            'id' => $patient->getId()
        ]);
    }

    /**
     * @Route("/patient/new", name="new_patient")
     */
    public function formCreatePatient(Request $request): Response {
        $entityManager = $this->getDoctrine()->getManager();

        $patient = new Patient();

        // FORM
        // TODO(aurel): Get the symptoms to show up!
        $form = $this->createForm(PatientType::class, $patient);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $patient = $form->getData();

            // these should be saved to the database later!
            $entityManager->persist($patient);

            // actually execute query
            $entityManager->flush();

            // redirecting to a page that new shows the new patient.
            return $this->redirectToRoute('patient_show', [
                'id' => $patient->getId()
            ]);
        }

        return $this->render('patient/new.html.twig', [
            'patient_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/patient/{id}", name="patient_show")
     */
    public function show($id) {
        $patient = $this->getDoctrine()
            ->getRepository(Patient::class)
            ->find($id);

        if(!$patient) {
            throw $this->createNotFoundException(
                'No patient found for id '.$id
            );
        }

        //return new Response('Patient '.$patient->getId().' is '.$patient->getName().' '.$patient->getSurname().'.');

        return $this->render('patient/show.html.twig', [
            'patient' => $patient,
        ]);


    }

    /**
     * @Route("/patient/edit/{id}")
     */
    public function update($id) {
        // fetching object from doctrine
        $entityManager = $this->getDoctrine()->getManager();
        $patient = $entityManager->getRepository(Patient::class)->find($id);

        if(!patient) {
            throw $this->createNotFoundException(
                'No Patient found for id '.$id
            );
        }

        // changing that object
        $patient->setName('Maya');

        // flushing changes to the database
        $entityManager->flush();

        // redirecting to a page that new shows the new patient.
        return $this->redirectToRoute('patient_show', [
            'id' => $patient->getId()
        ]);
    }

    /**
     * @Route("/patient/remove/{id}")
     */
    public function remove($id) {
        // fetching object from doctrine
        $entityManager = $this->getDoctrine()->getManager();
        $patient = $entityManager->getRepository(Patient::class)->find($id);

        if(!patient) {
            throw $this->createNotFoundException(
                'No Patient found for id '.$id
            );
        }

        // removing that object
        $entityManager->remove($patient);

        // flushing changes to the database
        $entityManager->flush();

        return $this->render('patient/removed.html.twig', [
            'id' => $id,
        ]);

    }
}
