<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
