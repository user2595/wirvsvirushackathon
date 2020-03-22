<?php

namespace App\Form;

use App\Entity\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('surname')
            ->add('birthdate')
            ->add('phoneNr')
            ->add('email')
            ->add('note')
            ->add('address')
            ->add('symptoms')
            ->add('preExistingConditions')
            ->add('riskFactors')
            ->add('appointment')
            ->add('test')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
