<?php

namespace App\Form;

use App\Entity\ReservationVoyage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ReservationVoyageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDepart',DateType::class, [
                // renders it as a single text box
                'widget' => 'single_text',
            ])
            ->add('dateArrivee',DateType::class, [
                // renders it as a single text box
                'widget' => 'single_text',
            ])
            ->add('etat')
            ->add('idu')
            ->add('refPaiement')
            ->add('idv')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReservationVoyage::class,
        ]);
    }
}
