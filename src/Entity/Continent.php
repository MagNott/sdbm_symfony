<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Continent
 *
 * @ORM\Table(name="continent")
 * @ORM\Entity(repositoryClass="App\Repository\ContinentRepository")
 */
class Continent
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_CONTINENT", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idContinent;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_CONTINENT", type="string", length=25, nullable=false)
     */
    private $nomContinent;




    // ICI C'EST POUR GERER LES STATS

    
    //Table continent est la base pour la requete "combien de marque par continent"
    //on ajoute $pays pour avoir accès à la relation 
    //on parametre sont ORM un OneToMany ET un mappedBy="idContinent" (on le branche a continent)
    //$pays n'est pas idPays car on parle de tous les pays ici (un tableau de pays)

    /**
     * @ORM\OneToMany(targetEntity="Pays", mappedBy="idContinent", cascade={"persist"}))
     */
    private $pays;


    // on créé un constructeur à cause de pays pour que $pays puisse être valorisé par un objet tableau (vide à ce moment précis ducode)
    public function __construct()
    {
        $this->pays = new ArrayCollection();
    }


    // ICI C'EST LA FIN DE LA GESTION DES STATS



    public function getIdContinent(): ?int
    {
        return $this->idContinent;
    }

    public function getNomContinent(): ?string
    {
        return $this->nomContinent;
    }

    public function setNomContinent(string $nomContinent): static
    {
        $this->nomContinent = $nomContinent;

        return $this;
    }


 
    
    

    public function __toString() {
        //C'est une méthode magique, ici on l'a surchargé, elle se voit pas de base
        // pour permettre d'avoir une représentation textuelle de l'objet Continent
        return $this->nomContinent;
        //On retourne le nom du continent courant
        //le nomContinent fait référence à la variable privée de classe (d'instance) $nomContinent
        // c'est grace a ce retour que l'on pourra remplir le combobox
    
    }


}
