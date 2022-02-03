<?php

namespace App\Form\Actes;

use App\Entity\Actes\ActesCategories;
use App\Entity\Actes\ActesPrestations;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActesPrestationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
            ->add('designation', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Designation de la prestations'
                ]
            ])
            ->add('categorie', EntityType::class,  [
                'class' => ActesCategories::class,
                'choice_label' => 'designation',
                'required' => true,
                'label' => 'Select one item',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
            'data_class' => ActesPrestations::class,
        ]);
    }
}
