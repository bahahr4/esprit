<?php
// src/Form/ReservationCelluleType.php

namespace App\Form;

use App\Entity\ReservationCellule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Email;

class ReservationCelluleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Médicale' => 'medical',
                    'Administratif' => 'administrative',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please select a type of reservation.',
                    ]),
                ],
            ])
            ->add('reason', TextareaType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please provide a reason for the reservation.',
                    ]),
                    new Length([
                        'min' => 10,
                        'max' => 500,
                        'minMessage' => 'The reason must be at least {{ limit }} characters long.',
                        'maxMessage' => 'The reason cannot be longer than {{ limit }} characters.',
                    ]),
                ],
            ])

            ->add('reservedAt', DateTimeType::class, [
                'widget' => 'single_text',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please provide a reserved date.',
                    ]),
                    new Type([
                        'type' => 'datetime',
                        'message' => 'The reserved date must be a valid date.',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReservationCellule::class,
        ]);
    }
}
