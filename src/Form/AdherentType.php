<?php

namespace App\Form;

use App\Entity\Adherent;
use App\Entity\Filiere;
use App\Entity\Poste;
use App\Entity\Role;
use App\Entity\Sexe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdherentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,[
                'label' => false,
                'required' => true,
            ])
            ->add('prenom',TextType::class,[
                'label' => false,
                'required' => true,
            ])
            ->add('sexe',EntityType::class,[
                'class' => Sexe::class,
                'label' => false,
                'choice_label' => 'nom'
            ])
            ->add('poste',EntityType::class,[
                'class' => Poste::class,
                'label' => false,
                'choice_label' => 'nom'
            ])
            ->add('filiere',EntityType::class,[
                'class' => Filiere::class,
                'label' => false,
                'choice_label' => 'nom',
            ])
            ->add('matricule',TextType::class,[
                'label' => false,
                'required' => true,
            ])
            ->add('mdp', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne coïncident pas',
                'required' => true,
                'first_options'  => ['label' => false ],
                'second_options' => ['label' => false],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adherent::class,
        ]);
    }
}
