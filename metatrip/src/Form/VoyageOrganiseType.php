<?php

namespace App\Form;

use App\Entity\VoyageOrganise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VoyageOrganiseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prixBillet')
            ->add('airline')
            ->add('nbplaces')
            ->add('etatvoyage', ChoiceType::class,
            array(
                'choices' => array(
                    'INDISPO'    =>'INDISPO',
                    'DISPO' => 'DISPO'
                  
            )))
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
