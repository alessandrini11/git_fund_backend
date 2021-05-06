<?php

namespace App\Form;

use App\Entity\Adherent;
use App\Entity\Filiere;
use App\Entity\Poste;
use App\Entity\Sexe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdherentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('sexe',EntityType::class,[
                'class' => Sexe::class,
                'choice_label' => 'nom'
            ])
            ->add('poste',EntityType::class,[
                'class' => Poste::class,
                'choice_label' => 'nom'
            ])
            ->add('filiere',EntityType::class,[
                'class' => Filiere::class,
                'choice_label' => 'nom'
            ])
            ->add('matricule')
            ->add('mdp')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adherent::class,
        ]);
    }
}
