<?php

namespace App\Form;

<<<<<<< HEAD
use App\Entity\reclamation;
use App\Entity\Reply;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
=======
use App\Entity\Reply;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
>>>>>>> 273b3dc5a7dc47d103f3e51cc1635e6c06d06212

class ReplyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
<<<<<<< HEAD
            ->add('content')
            ->add('createdate', null, [
                'widget' => 'single_text',
            ])
            ->add('reclamation', EntityType::class, [
                'class' => reclamation::class,
                'choice_label' => 'id',
            ])
        ;
=======
            // 'objet' field with validation for not blank and length constraints
            ->add('objet', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please provide a subject for your reply.',
                    ]),
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'The subject cannot be longer than {{ limit }} characters.',
                    ]),
                ],
                'label' => 'Subject',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter subject'
                ]
            ])

            // 'content' field with validation for not blank and length constraints
            ->add('content', TextareaType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please provide a reply content.',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Your reply must be at least {{ limit }} characters long.',
                        'max' => 2000,
                        'maxMessage' => 'Your reply cannot be longer than {{ limit }} characters.',
                    ]),
                ],
                'label' => 'Content',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Write your reply here...',
                    'rows' => 4
                ]
            ]);
>>>>>>> 273b3dc5a7dc47d103f3e51cc1635e6c06d06212
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reply::class,
        ]);
    }
}
