<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Couleur
 *
 * @ORM\Table(name="couleur")
 * @ORM\Entity(repositoryClass="App\Repository\CouleurRepository")
 */
class Couleur
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_COULEUR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCouleur;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_COULEUR", type="string", length=25, nullable=false)
     */
    private $nomCouleur;

    public function getIdCouleur(): ?int
    {
        return $this->idCouleur;
    }

    public function getNomCouleur(): ?string
    {
        return $this->nomCouleur;
    }

    public function setNomCouleur(string $nomCouleur): static
    {
        $this->nomCouleur = $nomCouleur;

        return $this;
    }

    public function __toString()
    {
        //C'est une méthode magique, ici on l'a surchargé, elle se voit pas de base
        // pour permettre d'avoir une représentation textuelle de l'objet Couleur
        return $this->nomCouleur;
        //On retourne le nom du couleur courant
        //le nomCouleur fait référence à la variable privée de classe (d'instance) $nomCouleur
        // c'est grace a ce retour que l'on pourra remplir le combobox
    }
}
