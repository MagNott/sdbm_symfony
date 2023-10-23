<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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

    /**
     * @var \Continent|null
     *
     * @ORM\ManyToOne(targetEntity="Continent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_CONTINENT", referencedColumnName="ID_CONTINENT")
     * })
     */
    private $idContinent;



    
//TEST

/**
 * @ORM\OneToMany(targetEntity="Marque", mappedBy="pays")
 */
private $idMarque;

//FIN TEST




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
