<?php

// src/Form/PatientType.php
namespace App\Form;

use App\Entity\Patient;

use App\Entity\Symptom;
use App\Entity\PreExistingCondition;
use App\Entity\RiskFactor;

use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


use App\Form\AddressType;

class PatientType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        // NOTE(aurel): regular fields don't need any special attention. The formbuilder is smart enough to
        //              detect the correct fields.
        $builder->add('name');
        $builder->add('surname');
        $builder->add('birthdate');
        $builder->add('phoneNr');
        $builder->add('email');

        // NOTE(aurel): creates a new address entity
        $builder->add('address', AddressType::class);
        
        // NOTE(aurel): creates a new patientSymptom entity for the ManyToMany-relation between patient
        //              and symptoms.
        // TODO(aurel): The symptoms don't show up yet.
        $builder->add('patientSymptoms', CollectionType::class, [
            'entry_type' => PatientSymptomsEmbeddedType::class,
        ]);

        // NOTE(aurel): queries all existing pre-existing conditions/risk factors form the database and lists
        //              them. Multiple choices are allowed and show all of the choices instead of hiding them
        //              in a drop-down list.
        $builder->add('preExistingConditions', EntityType::class, [
            'class' => PreExistingCondition::class,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('u')->orderBy('u.name', 'ASC');
            },
            'choice_label' => function ($condition) {
                return $condition->getName();
            },
            'expanded' => true,
            'multiple' => true,
        ]);
        $builder->add('riskFactors', EntityType::class, [
            'class' => RiskFactor::class,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('u')->orderBy('u.name', 'ASC');
            },
            'choice_label' => function ($riskFactor) {
                return $riskFactor->getName();
            },
            'expanded' => true,
            'multiple' => true,
        ]);

        $builder->add('save', SubmitType::class); // simple submit button
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
