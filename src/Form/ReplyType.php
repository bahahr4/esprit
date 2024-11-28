<?php

namespace App\Form;

use App\Entity\reclamation;
use App\Entity\Reply;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReplyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content')
            ->add('createdate', null, [
                'widget' => 'single_text',
            ])
            ->add('reclamation', EntityType::class, [
                'class' => reclamation::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reply::class,
        ]);
    }
}