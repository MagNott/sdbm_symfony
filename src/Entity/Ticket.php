<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="App\Repository\TicketRepository")
 */
class Ticket
{
    /**
     * @var int
     *
     * @ORM\Column(name="ANNEE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $annee;

    /**
     * @var int
     *
     * @ORM\Column(name="NUMERO_TICKET", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $numeroTicket;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATE_VENTE", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateVente;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Article", inversedBy="annee")
     * @ORM\JoinTable(name="vendre",
     *   joinColumns={
     *     @ORM\JoinColumn(name="ANNEE", referencedColumnName="ANNEE"),
     *     @ORM\JoinColumn(name="NUMERO_TICKET", referencedColumnName="NUMERO_TICKET")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ID_ARTICLE", referencedColumnName="ID_ARTICLE")
     *   }
     * )
     */
    private $idArticle;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idArticle = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dateVente = new DateTime();
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function getNumeroTicket(): ?int
    {
        return $this->numeroTicket;
    }

    public function getDateVente(): ?\DateTimeInterface
    {
        return $this->dateVente;
    }

    public function setDateVente(\DateTimeInterface $dateVente): static
    {
        $this->dateVente = $dateVente;

        return $this;
    }

    //ajout du setter de année
    public function setAnnee(int $annee): self
    {
       $this->annee = $annee;
       return $this;
    }
    

    //ajout du setter de numero de ticket
    public function setNumeroTicket(int $numero): self
    {
       $this->numeroTicket = $numero;
       return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getIdArticle(): Collection
    {
        return $this->idArticle;
    }

    public function addIdArticle(Article $idArticle): static
    {
        if (!$this->idArticle->contains($idArticle)) {
            $this->idArticle->add($idArticle);
        }

        return $this;
    }

    public function removeIdArticle(Article $idArticle): static
    {
        $this->idArticle->removeElement($idArticle);

        return $this;
    }

}
