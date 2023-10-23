<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomArticle', TextType::class, [
                'attr' =>
                ['class' => 'form-control form-control-sm']
            ])
            ->add('prixAchat', TextType::class, [
                'attr' =>
                ['class' => 'form-control form-control-sm']
            ])
            ->add('volume', TextType::class, [
                'attr' =>
                ['class' => 'form-control form-control-sm']
            ])
            ->add('titrage', TextType::class, [
                'attr' =>
                ['class' => 'form-control form-control-sm']
            ])
            ->add('idCouleur', null, [
                'label' => 'Couleur',
                'attr' =>
                ['class' => 'form-control form-control-sm']
            ])
            ->add('idMarque', null, [
                'label' => 'Marque',
                'attr' =>
                ['class' => 'form-control form-control-sm']
            ])
            ->add('idType', null, [
                'label' => 'Type de bière',
                'attr' =>
                ['class' => 'form-control form-control-sm']
            ])
            // ->add('annee', TextType::class, [
            //     'attr' =>
            //     ['class' => 'form-control form-control-sm']
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
