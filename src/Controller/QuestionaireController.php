<?php
namespace App\Controller;

use App\Entity\Task;
use App\Form\PatientType;
use App\Entity\Patient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class QuestionaireController extends AbstractController
{
    public function new(Request $request)
    {
        $task = new Patient();
        // ...

        $form = $this->createForm(PatientType::class, $task);

        return $this->render('patient/questionaire.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
?>