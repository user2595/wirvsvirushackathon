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
        $builder->add('birthdate', DateType::class, [
            'format' => 'dd.MM.yyyy',
            'help' => 'Geburtstag im Fomrat tt.mm.jjjj',
            'years' => [1880,1881,1882,1883,1884,1885,1886,1887,1888,1889,1890,1891,1892,1893,1894,1895,1896,1897,1898,1899,1900,1901,1902,1903,1904,1905,1906,1907,1908,1909,1910,1911,1912,1913,1914,1915,1916,1917,1918,1919,1920,1921,1922,1923,1924,1925,1926,1927,1928,1929,1930,1931,1932,1933,1934,1935,1936,1937,1938,1939,1940,1941,1942,1943,1944,1945,1946,1947,1948,1949,1950,1951,1952,1953,1954,1955,1956,1957,1958,1959,1960,1961,1962,1963,1964,1965,1966,1967,1968,1969,1970,1971,1972,1973,1974,1975,1976,1977,1978,1979,1980,1981,1982,1983,1984,1985,1986,1987,1988,1989,1990,1991,1992,1993,1994,1995,1996,1997,1998,1999,2000,2001,2002,2003,2004,2005,2006,2007,2008,2009,2010,2011,2012,2013,2014,2015,2016,2017,2018,2019,2020]
            //'widget' => 'single_text',
        ]);
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
