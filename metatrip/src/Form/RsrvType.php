<?php

namespace App\Form;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Entity\ReservationVoyage;
use App\Entity\User;
use App\Entity\Voyage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RsrvType extends AbstractType
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
            ->add('idu',EntityType::class,[
                'class'=>User::class,
                'choice_label'=>'nom',
                'disabled'=>'true',
                'multiple'=>false
            ]) 
            ->add('idv',EntityType::class,[
                'class'=>Voyage::class,
                'choice_label'=>'pays',
                'disabled'=>'true',
                'multiple'=>false
            ]) 
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReservationVoyage::class,
        ]);
    }
}
