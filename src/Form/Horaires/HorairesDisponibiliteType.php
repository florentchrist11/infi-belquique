<?php

namespace App\Form\Horaires;

use App\Entity\Horaires\HorairesDisponibilite;
use App\Entity\Horaires\HorairesJours;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HorairesDisponibiliteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startAt', TimeType::class, [
                'input' => 'datetime',
                'widget' => 'choice',
            ])
            ->add('finishAt', TimeType::class, [
                'input' => 'datetime',
                'widget' => 'choice',
            ])
            ->add('jour', EntityType::class, [
                'class' => HorairesJours::class,
                'choice_label' => 'designation',
                'required' => true,
                'label' => 'Select one item',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HorairesDisponibilite::class,
        ]);
    }
}
