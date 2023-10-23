<?php

namespace App\Form;

use App\Entity\Pays;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaysType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomPays', TextType::class, [
                //En ajoutant le TextType::class le use s'est mis tout seul grâce à l'auto import de php namespace (l'extension)
                'attr' => [
                            'class' => 'form-control form-control-sm'
                            //On peut en ajouter tant qu'on veut
                            ]
            ] )
            //Adaptation du formulaire
            //2eme parametre on indique qu'il s'agit d'un champs text grace a la classe TextType
            //3eme parametre on ajoute les attirbut html du champ pour utiliser bootstrap

            ->add('idContinent', null, [
                //Le 2eme ADD reçoit NULL en paramètre car c'est un COMBOX (==> Il faut laisser Symfony gérer)
                'label' => 'Continent', // Cette ligne permet de personnaliser le label du champ
                'attr' => [
                            'class' => 'select-control select-control-sm'
                            //On peut en ajouter tant qu'on veut
                            ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pays::class,
        ]);
    }
}
