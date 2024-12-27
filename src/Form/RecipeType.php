<?php

namespace App\Form;

use App\Entity\Recipe;
use App\Entity\Ingredient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('label')
        ->add('description')
        ->add('duration')
        ->add('personCount')
        ->add('photo')
        ->add('recipeIngredients', CollectionType::class, [
            'entry_type' => RecipeIngredientType::class,  // Formulaire pour RecipeIngredient
            'allow_add' => true,
            'by_reference' => false,  // Important pour que la collection soit mise à jour
            'allow_delete' => true,
            'label' => "Ingrédients",
            'prototype' => true,  // Pour générer le prototype d'ingrédient
            'prototype_name' => '__name__',  // Nom utilisé dans le prototype (pour le JavaScript)
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
