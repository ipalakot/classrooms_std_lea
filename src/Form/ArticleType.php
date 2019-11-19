<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;




class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'titre'
            ])
            ->add('content')
            ->add('image')
            ->add('created_At')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
