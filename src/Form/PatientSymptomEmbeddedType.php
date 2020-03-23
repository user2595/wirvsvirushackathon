<?php

namespace App\Form;

use App\Entity\PatientSymptom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Doctrine\ORM\EntityRepository;

use App\Entity\Symptom;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PatientSymptomEmbeddedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder ->add('symptom', EntityType::class, [
            'class' => Symptom::class,
            'query_builder' => function (EntityRepository $er) {
                return $er->queryAllOrderedByName();
            },
            'choice_label' => 'name',
            'expanded' => false,
            'multiple' => false,
        ]);
        $builder->add('startingDate');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PatientSymptom::class,
        ]);
    }
}
