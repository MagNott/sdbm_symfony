<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Pays
 *
 * @ORM\Table(name="pays", indexes={@ORM\Index(name="FK_PAYS_CONTINENT", columns={"ID_CONTINENT"})})
 * @ORM\Entity(repositoryClass="App\Repository\PaysRepository")
 */
class Pays
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_PAYS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPays;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_PAYS", type="string", length=40, nullable=false)
     */
    private $nomPays;

    


    // POUR LES STATS IL A FALLU RAJOUTER LE INVERSED BY ET POINTER SUR LA VARIABLE DE CLASSE DE L'ENTITE CONTINENT

    /**
     * @var \Continent|null
     *
     * @ORM\ManyToOne(targetEntity="Continent", inversedBy="pays")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_CONTINENT", referencedColumnName="ID_CONTINENT")
     * })
     */
    private $idContinent;


    
    //POUR LES STATS ICI ON RAJOUTE MARQUE POUR PREPARER LA RELATION
    // on répercute ce qu'on a fait dans continent pour pays, la on le fait de pays pour marque
    // $idPays pointe vers la variable de classe qui se trouve dans entity marque

    /**
     * @ORM\OneToMany(targetEntity="Marque", mappedBy="idPays")
     */
    private $marques;



    // IL FAUT AUSSI FAIRE LE CONSTRUCTEUR
    // TOUT CA C'EST LA FAUT A LA BASE DE DONNEE IMPORTEE
    // Il faut faire le construct pour pouvoir valiroser marques avec un objet tableau (vide pour le moment)
    public function __construct()
    {
        $this->marques = new ArrayCollection();
    }

    //FIN DES TRUCS POUR LES STATS


    public function getIdPays(): ?int
    {
        return $this->idPays;
    }

    public function getNomPays(): ?string
    {
        return $this->nomPays;
    }

    public function setNomPays(string $nomPays): static
    {
        $this->nomPays = $nomPays;

        return $this;
    }

    public function getIdContinent(): ?Continent
    {
        return $this->idContinent;
    }

    public function setIdContinent(?Continent $idContinent): static
    {
        $this->idContinent = $idContinent;

        return $this;
    }



//TEST
public function getIdMarque(): ?Marque
{
    return $this->idMarque;
}

public function setIdMarque(?Marque $idMarque): static
{
    $this->idMarque = $idMarque;

    return $this;
}   

//FIN TEST




    public function __toString() {
        //C'est une méthode magique, ici on l'a surchargé, elle se voit pas de base
        // pour permettre d'avoir une représentation textuelle de l'objet Continent
        return $this->nomPays;
        //On retourne le nom du continent courant
        //le nomContinent fait référence à la variable privée de classe (d'instance) $nomContinent
        // c'est grace a ce retour que l'on pourra remplir le combobox
    
    }
}
