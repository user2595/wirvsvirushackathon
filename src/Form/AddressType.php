<?php

// src/Form/AddressType.php
namespace App\Form;

use App\Entity\Address;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;

class AddressType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('street', TextType::class);
        $builder->add('nr', TextType::class);
        $builder->add('city', TextType::class);
        $builder->add('country', TextType::class);
        $builder->add('zipCode', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}


