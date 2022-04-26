<?php

namespace App\Form;

use App\Entity\Movie;
use App\Entity\Artiste;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description'
            ])
            ->add('datesortie', DateType::class, [
                'label' => 'Date de sortie',
                'years' => range(1900, 2022),
            ])
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'imagine_pattern' => 'my_thumb',
                'label' => 'Photo',
                'allow_delete' => false,
                'download_uri' => false,
            ])
            ->remove('updatedAt')
            ->add('actors', EntityType::class, [
                'class' => Artiste::class,
                'label' => 'Acteur',
                'expanded' => true,
                'multiple' => true
            ])
            ->add('realistor', EntityType::class, [
                'class' => Artiste::class,
                'label' => 'Réalisateur'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
