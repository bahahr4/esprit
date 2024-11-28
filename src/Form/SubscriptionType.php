<?php

namespace App\Form;

use App\Entity\Library;
use App\Entity\Subscription;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
<<<<<<< HEAD
use Symfony\Component\Form\Extension\Core\Type\NumberType;
=======
>>>>>>> 273b3dc5a7dc47d103f3e51cc1635e6c06d06212
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type')
<<<<<<< HEAD
            ->add('price', NumberType::class, [
                'scale' => 2, // For decimal places if needed
                'html5' => true,
                'attr' => [
                    'step' => '0.01', // For fractional inputs
                ],
            ])
=======
            ->add('price')
>>>>>>> 273b3dc5a7dc47d103f3e51cc1635e6c06d06212
            ->add('startDate', null, [
                'widget' => 'single_text'
            ])
            ->add('endDate', null, [
                'widget' => 'single_text'
            ])
            ->add('library', EntityType::class, [
                'class' => Library::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Subscription::class,
        ]);
    }
}
