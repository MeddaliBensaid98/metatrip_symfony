<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Abonnement
 *
 * @ORM\Table(name="abonnement", indexes={@ORM\Index(name="Ida", columns={"Ida"}), @ORM\Index(name="FK_pai", columns={"Ref_paiement"})})
 * @ORM\Entity
 */
class Abonnement
{
    /**
     * @var int
     *
     * @ORM\Column(name="Ida", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ida;

    /**
     * @var string
     * @ORM\Column(name="Type", type="string", length=20, nullable=false)

     */
    private $type;

    /**
     * @var int
     *@Assert\NotBlank
     * @ORM\Column(name="Prix_a", type="integer", nullable=false)
     */
    private $prixA;

    /**
     * @var \DateTime
     *@Assert\NotBlank
     * @ORM\Column(name="Date_achat", type="date", nullable=false)
     * @Assert\GreaterThan("today", message="Veuillez choisir une date plus recente que cette date")
     */
    private $dateAchat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_expiration", type="date", nullable=false)
     * @Assert\Expression("this.getDateAchat() < this.getDateExpiration()", message="Veuillez vérifier la date d'expiration")
     */
    private $dateExpiration;

    /**
     * @var string
     *@Assert\NotBlank
     * @ORM\Column(name="Etat", type="string", length=20, nullable=false)
     */
    private $etat;

    /**
     * @var \Paiement
     *@Assert\NotBlank
     * @ORM\ManyToOne(targetEntity="Paiement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Ref_paiement", referencedColumnName="Ref_paiement")
     * })
     */
    private $refPaiement;

    public function getIda(): ?int
    {
        return $this->ida;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPrixA(): ?int
    {
        return $this->prixA;
    }

    public function setPrixA(int $prixA): self
    {
        $this->prixA = $prixA;

        return $this;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->dateAchat;
    }

    public function setDateAchat(\DateTimeInterface $dateAchat): self
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }

    public function getDateExpiration(): ?\DateTimeInterface
    {
        return $this->dateExpiration;
    }

    public function setDateExpiration(\DateTimeInterface $dateExpiration): self
    {
        $this->dateExpiration = $dateExpiration;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getRefPaiement(): ?Paiement
    {
        return $this->refPaiement;
    }

    public function setRefPaiement(?Paiement $refPaiement): self
    {
        $this->refPaiement = $refPaiement;

        return $this;
    }
    public function  __toString(){
        // to show the name of the Category in the select
        return $this->type ;
        // to show the id of the Category in the select
        // return $this->id;
    }

}
