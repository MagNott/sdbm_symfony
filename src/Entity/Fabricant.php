<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fabricant
 *
 * @ORM\Table(name="fabricant")
 * @ORM\Entity(repositoryClass="App\Repository\FabricantRepository")
 */
class Fabricant
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_FABRICANT", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFabricant;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_FABRICANT", type="string", length=40, nullable=false)
     */
    private $nomFabricant;

    public function getIdFabricant(): ?int
    {
        return $this->idFabricant;
    }

    public function getNomFabricant(): ?string
    {
        return $this->nomFabricant;
    }

    public function setNomFabricant(string $nomFabricant): static
    {
        $this->nomFabricant = $nomFabricant;

        return $this;
    }

    public function __toString() {
        //C'est une méthode magique, ici on l'a surchargé, elle se voit pas de base
        // pour permettre d'avoir une représentation textuelle de l'objet Continent
        return $this->nomFabricant;
        //On retourne le nom du continent courant
        //le nomContinent fait référence à la variable privée de classe (d'instance) $nomContinent
        // c'est grace a ce retour que l'on pourra remplir le combobox
    
    }
}
