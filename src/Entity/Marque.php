<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Marque
 *
 * @ORM\Table(name="marque", indexes={@ORM\Index(name="FK_MARQUE_PAYS", columns={"ID_PAYS"}), @ORM\Index(name="FK_MARQUE_FABRICANT", columns={"ID_FABRICANT"})})
 * @ORM\Entity(repositoryClass="App\Repository\MarqueRepository")
 */
class Marque
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_MARQUE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMarque;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_MARQUE", type="string", length=40, nullable=false)
     */
    private $nomMarque;

    /**
     * @var \Fabricant|null
     *
     * @ORM\ManyToOne(targetEntity="Fabricant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_FABRICANT", referencedColumnName="ID_FABRICANT")
     * })
     */
    private $idFabricant;


    // POUR LES STATS on s'assure que on a bien le inversed by marques (ref à $mrques qui est dans pays)
    // c'est le bout de la chaine de nos stats donc on a pas besoin de faire plus

    /**
     * @var \Pays|null
     *
     * @ORM\ManyToOne(targetEntity="Pays", inversedBy="marques")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_PAYS", referencedColumnName="ID_PAYS")
     * })
     */
    private $idPays;


     // FIN DES MODIFS POUR LES STATS   


    public function getIdMarque(): ?int
    {
        return $this->idMarque;
    }

    public function getNomMarque(): ?string
    {
        return $this->nomMarque;
    }

    public function setNomMarque(string $nomMarque): static
    {
        $this->nomMarque = $nomMarque;

        return $this;
    }

    public function getIdFabricant(): ?Fabricant
    {
        return $this->idFabricant;
    }

    public function setIdFabricant(?Fabricant $idFabricant): static
    {
        $this->idFabricant = $idFabricant;

        return $this;
    }

    public function getIdPays(): ?Pays
    {
        return $this->idPays;
    }

    public function setIdPays(?Pays $idPays): static
    {
        $this->idPays = $idPays;

        return $this;
    }

    public function __toString()
    {
        //C'est une méthode magique, ici on l'a surchargé, elle se voit pas de base
        // pour permettre d'avoir une représentation textuelle de l'objet Marque
        return $this->nomMarque;
        //On retourne le nom du Marque courant
        //le nomMarque fait référence à la variable privée de classe (d'instance) $nomMarque
        // c'est grace a ce retour que l'on pourra remplir le combobox
    }
}
