<?php

namespace App\Form;

use App\Entity\VoyageOrganise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoyageOrganiseType extends AbstractType
{
    ##ffff
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prixBillet')
            ->add('airline')
            ->add('nbNuitees')
            ->add('etatvoyage')
            ->add('nbplaces')
            ->add('idv')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VoyageOrganise::class,
        ]);
    }
}
