<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Library;

class LibraryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Please provide a name for the library.']),
                    new Assert\Length([
                        'max' => 255,
                        'maxMessage' => 'The name cannot exceed {{ limit }} characters.',
                    ]),
                ],
                'label' => 'Library Name',
                'attr' => ['placeholder' => 'Enter the library name']
            ])
            ->add('bloc', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Please provide the bloc.']),
                ],
                'label' => 'Bloc',
                'attr' => ['placeholder' => 'Enter the bloc']
            ])
            ->add('description', TextType::class, [
                'constraints' => [
                    new Assert\Length([
                        'max' => 1000,
                        'maxMessage' => 'The description cannot exceed {{ limit }} characters.',
                    ]),
                ],
                'label' => 'Description',
                'required' => false,
                'attr' => ['placeholder' => 'Enter a brief description']
            ])
            ->add('contact', TextType::class, [
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/^\+?[0-9\s-]{7,15}$/',
                        'message' => 'The contact must be a valid phone number.',
                    ]),
                ],
                'label' => 'Contact',
                'required' => false,
                'attr' => ['placeholder' => 'Enter a valid phone number']
            ])
            ->add('openingHours', TextType::class, [
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/^\d{2}:\d{2}-\d{2}:\d{2}$/',
                        'message' => 'Opening hours must be in the format HH:MM-HH:MM.',
                    ]),
                ],
                'label' => 'Opening Hours',
                'required' => false,
                'attr' => ['placeholder' => 'e.g., 09:00-17:00']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Library::class,
        ]);
    }
}
