<?php

namespace App\Form;

use App\Entity\ReservationHotel;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationHotel1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nbNuitees')
            ->add('nbPersonnes')
            //->add('prix')
            ->add('dateDepart',DateTimeType::class,['date_widget' => 'single_text'])
            ->add('dateArrivee',DateTimeType::class,['date_widget' => 'single_text'])
            ->add('idu')
            ->add('idh')
            ->add('add',SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReservationHotel::class,
        ]);
    }
}