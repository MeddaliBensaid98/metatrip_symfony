<?php

namespace App\Form;

use App\Entity\VoyageVirtuel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoyageVirtuel1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('video')
            ->add('nom')

            ->add('imageV')
            ->add('ida')
            ->add('idv')
            ->add('next',SubmitType::class)
            ->add('Edit',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VoyageVirtuel::class,
        ]);
    }
}
