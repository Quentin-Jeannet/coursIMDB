<?php

namespace App\Form;

use App\Entity\Artiste;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArtisteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prenom',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('birthdate', DateType::class, [
                'label' => 'Date de naissance',
                'years' => range(1900,2022),
            ])
            ->add('imageFile' ,VichImageType::class, [
                'required' => false,
                'imagine_pattern' => 'my_thumb',
                'label' => 'Photo',
                'attr' => [
                    'class' => 'form-control'
                ],
                'allow_delete' => false,
                'download_uri' => false,
            ])
            ->remove('updatedAt')
            ->remove('movies')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artiste::class,
        ]);
    }
}
