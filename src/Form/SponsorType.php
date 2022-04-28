<?php

namespace App\Form;

use App\Entity\Evenement;
use App\Entity\Sponsor;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class SponsorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomsponsor')
            ->add('tel')
            ->add('email')

            ->add('imageFile',VichImageType::class,[
                'required' => true
            ])

            ->add('dateSp' ,DateType::class, [
                // renders it as a single text box
                'required' => true,
                'widget' => 'single_text'
            ])

            ->add('prixSp')
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
            'data_class' => Sponsor::class,
        ]);
    }
}
