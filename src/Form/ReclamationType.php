<?php

namespace App\Form;

use App\Entity\Reclamation;
use Symfony\Component\Form\AbstractType;
<<<<<<< HEAD
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
=======
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Email;
>>>>>>> 273b3dc5a7dc47d103f3e51cc1635e6c06d06212

class ReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', TextType::class, [
<<<<<<< HEAD
                'label' => 'Type de Réclamation',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => ['class' => 'form-control', 'rows' => 5],
            ]);
=======
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please provide a type for the reclamation.',
                    ]),
                    new Length([
                        'max' => 100,
                        'maxMessage' => 'The type cannot be longer than {{ limit }} characters.',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z\s]+$/',  // Only letters and spaces
                        'message' => 'The type can only contain letters and spaces.',
                    ])
                ],
            ])
            ->add('description', TextareaType::class);
>>>>>>> 273b3dc5a7dc47d103f3e51cc1635e6c06d06212
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}
