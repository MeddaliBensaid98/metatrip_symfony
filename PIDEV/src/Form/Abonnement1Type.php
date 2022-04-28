<?php

namespace App\Form;

use App\Entity\Abonnement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Abonnement1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idu')

            ->add('type')
            ->add('prixA')
            ->add('dateAchat')
            ->add('dateExpiration')
            ->add('etat')
            ->add('refPaiement')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Abonnement::class,

        ]);
    }
}
