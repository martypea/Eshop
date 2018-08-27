<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description',TextareaType::class, [])
            ->add('price')
            ->add('specialPrice')
            ->add('store')
            ->add('category', EntityType::class, [
                                          'class' => 'App\Entity\ProductCategory', 
                                          'choice_label' => 'name',
                                          ])
            ->add('tag', EntityType::class, [
                                          'class' => 'App\Entity\ProductTag', 
                                          'choice_label' => 'name',
                                          'multiple'=> true,
                                          'expanded'=> true,
                                           ])
            ->add('released', CheckboxType::class, array(
                                           'label'    => 'Show this entry publicly?',
                                           'required' => false,
                                           ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
