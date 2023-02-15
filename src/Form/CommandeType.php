<?php

namespace App\Form;

use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Repas;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('repas', EntityType::class,[ 'class' => Repas::class, 
            'choice_label' => 'nom',
            'mapped' => false])

            ->add('quantite', IntegerType::class,['attr'=>['class' => Repas::class] , 
            'label' => 'quantite',
            'mapped' => false])

            ->add('dateTime', DateTimeType::class,['attr'=> ['class' => Repas::class], 
            'label' => 'dateTime',
            'mapped' => false])

            ->add('lieu', TextType::class,['attr'=> [ 'class' => Repas::class], 
            'label' => 'lieu',
            'mapped' => false])

            ->add('ville', TextType::class,['attr'=> [ 'class' => Repas::class], 
            'label' => 'ville',
            'mapped' => false])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
