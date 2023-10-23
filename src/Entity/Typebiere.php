<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Typebiere
 *
 * @ORM\Table(name="typebiere")
 * @ORM\Entity(repositoryClass="App\Repository\TypebiereRepository")
 */
class Typebiere
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_TYPE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idType;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_TYPE", type="string", length=25, nullable=false)
     */
    private $nomType;

    public function getIdType(): ?int
    {
        return $this->idType;
    }

    public function getNomType(): ?string
    {
        return $this->nomType;
    }

    public function setNomType(string $nomType): static
    {
        $this->nomType = $nomType;

        return $this;
    }

    public function __toString()
    {
        //C'est une méthode magique, ici on l'a surchargé, elle se voit pas de base
        // pour permettre d'avoir une représentation textuelle de l'objet Type
        return $this->nomType;
        //On retourne le nom du Type courant
        //le nomType fait référence à la variable privée de classe (d'instance) $nomType
        // c'est grace a ce retour que l'on pourra remplir le combobox
    }
}
