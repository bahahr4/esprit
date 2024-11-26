<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Student;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type')
            ->add('details')
            ->add('eventDate', null, [
                'widget' => 'single_text'
            ])
            ->add('requestedAt', null, [
                'widget' => 'single_text'
            ])
            ->add('status')
            ->add('adminNotes')
            ->add('student', EntityType::class, [
                'class' => Student::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
