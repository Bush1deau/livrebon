<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiculeLivreurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('vehicule', ChoiceType::class, [
            'choices'  => [
                'Voiture' => 'Voiture',
                'Vélo' => 'Vélo',
                'Moto' => 'Moto',
                'Trotinette' => 'Trotinette',
            ],
            'mapped' => false, 'required' => true
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
