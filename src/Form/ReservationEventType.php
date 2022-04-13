<?php

namespace App\Form;

use App\Entity\Evenement;
use App\Entity\ReservationEvent;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nbPers')
            ->add('idu' ,  EntityType::Class,array(
                'class' => User::class,
                'choice_label'=>'cin',
                'label' =>'Selection des users',
                'multiple' => false,
                'required' => true
            ) )
            ->add('ide' , EntityType::Class,array(
                'class' => Evenement::class,
                'choice_label'=>'chanteur',
                'label' =>'Selection des chanteurs',
                'multiple' => false,
                'required' => true
            ) )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReservationEvent::class,
        ]);
    }
}
