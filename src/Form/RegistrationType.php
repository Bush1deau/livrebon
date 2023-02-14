<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom' , TextType::class , [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'form-label mt-4' 
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])




            ->add('prenom' , TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Prénom',
                'label_attr' => [
                    'class' => 'form-label mt-4' 
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])




            ->add('email' , EmailType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Email',
                'label_attr' => [
                    'class' => 'form-label mt-4' 
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Email()
                ]
            ])




            ->add('password', PasswordType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Mot de passe',
                'label_attr' => [
                    'class' => 'form-label mt-4' 
                ],
                'constraints' => [
                    new Assert\NotBlank()
                ]
            ])




            ->add('ville' , TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Ville',
                'label_attr' => [
                    'class' => 'form-label mt-4' 
                ],
                'constraints' => [
                    new Assert\NotBlank()
                ]
            ])




            ->add('adresse' , TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Adresse',
                'label_attr' => [
                    'class' => 'form-label mt-4' 
                ],
                'constraints' => [
                    new Assert\NotBlank()
                ]
            ])

     
            ->add('typeCompte', ChoiceType::class, [
                'choices'  => [
                    'Client' => 'ROLE_CLIENT',
                    'Livreur' => 'ROLE_LIVREUR',
                    'Restaurateur' => 'ROLE_RESTAURATEUR',
                ],
                'mapped' => false, 'required' => true
            ])

            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new Assert\IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
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
