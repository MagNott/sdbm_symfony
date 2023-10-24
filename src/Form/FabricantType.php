<?php

namespace App\Form;

use App\Entity\Fabricant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FabricantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomFabricant', TextType::class, [
                'label' => 'Nom',
                'attr'=> [
                    'class' => 'form-control form-control-sm', 'require'=> true
                    ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fabricant::class,
        ]);
    }
}
