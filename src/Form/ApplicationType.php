<?php

namespace App\Form;

use App\Entity\Application;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApplicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cvFile', FileType::class, [
                'label' => 'CV (PDF file)',
                'required' => true,
            ])
            ->add('etablissement', TextType::class, [
                'label' => 'Etablissement',
                'required' => true,
            ])
            ->add('diplome', TextType::class, [
                'label' => 'Diplôme',
                'required' => true,
            ])
            ->add('motivationLetter', FileType::class, [
                'label' => 'Motivation Letter',
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Application::class,
        ]);
    }
}
