<?php

namespace App\Form;

use App\Entity\Marque;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MarqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomMarque', TextType::class, [                
                'label' => 'Nom',
                'attr' => [
                            'class' => 'form-control form-control-sm'
                           ]
            ])

            ->add('idFabricant', null, [
                'label' => 'Fabricants',
                'attr' => [
                           'class' => 'form-select form-select-sm'
                          ]
            ])

            ->add('idPays', null, [
                'label' => 'Pays',
                'attr' => [
                           'class' => 'form-select form-select-sm'
                          ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Marque::class,
        ]);
    }
}
