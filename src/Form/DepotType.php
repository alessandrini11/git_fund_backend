<?php

namespace App\Form;

use App\Entity\Adherent;
use App\Entity\Depot;
use App\Entity\Somme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DepotType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adherents',EntityType::class,[
                'class' => Adherent::class,
                'label' => false,
                'choice_label' => function(Adherent $adherent){
                    return $adherent->getNom().' '.$adherent->getPrenom();
                }
            ])
            ->add('somme',EntityType::class,[
                'class' => Somme::class,
                'choice_label' => 'nom',
                'label' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Depot::class,
        ]);
    }
}
