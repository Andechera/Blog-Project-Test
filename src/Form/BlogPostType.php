<?php

namespace App\Form;

use App\Entity\BlogPost;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;

// BlogPostType è il form usato per la creazione e modifica di un post.
class BlogPostType extends AbstractType
{
    // Aggiunge campi per titolo, contenuto, e data creazione.
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Usa le opzioni di Symfony per validare e visualizzare correttamente i campi del form.
        $builder
            ->add('titolo', TextType::class, [
                'label' => 'Inserisci il Titolo',
                'attr' => [
                    'name' => 'titolo',
                    'class' => 'form-control',
                    'placeholder' => 'Titolo...'
                ],
                'constraints' => [
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Il titolo deve contenere almeno 10 caratteri',
                    ]),
                    new NotNull([
                        'message' => 'Il titolo non può essere nullo',
                    ])
                ]
            ])
            ->add('contenuto', TextareaType::class, [
                'label' => 'Inserisci il Contenuto',
                'required' => false,
                'attr' => [
                    'name' => 'contenuto',
                    'class' => 'form-control',
                    'placeholder' => 'Contenuto...',
                    'style' => 'height: 200px'
                    
                ]
            ])
            ->add('createdAt', null,
                [
                    'widget' => 'single_text',
                    'attr' => [
                        'name' => 'createdAt',
                        'class' => 'form-control w-25',
                        'hidden'=>true
                    ]
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BlogPost::class,
        ]);
    }
}
