<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Serializable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Vich\UploaderBundle\Entity\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

use Symfony\Component\Validator\Constraints as Assert;


use App\Form\PriceSearchType;


/**
 * Evenement
 *
 * @Vich\Uploadable
 * @ORM\Table(name="evenement")
 * @ORM\Entity
 */
class Evenement
{
    /**
     * @var int
     *
     *
     * @ORM\Column(name="Ide", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ide;

    /**
     * @var string
     *
     * @Assert\NotBlank
     * @ORM\Column(name="Type_event", type="string", length=20, nullable=false)
     */
    private $typeEvent;

    /**
     * @var string
     *
     * @Assert\NotBlank
     * @ORM\Column(name="Chanteur", type="string", length=20, nullable=false)
     */
    private $chanteur;

    /**
     * @var string
     *
     * @Assert\NotBlank
     * @ORM\Column(name="Adresse", type="string", length=20, nullable=false)
     */
    private $adresse;

    /**
     * @var \DateTime
     *
     * @Assert\NotBlank
     * @ORM\Column(name="Date_event", type="date", nullable=false)
     */
    private $dateEvent;

    /**
     * @var float
     *
     * @Assert\NotBlank
     *  @Assert\Positive
     * @ORM\Column(name="prix_e", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixE;

    /**
     * @var string
     *
     * @Assert\NotBlank
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity=Sponsor::class, inversedBy="evenements")
     */
    private $sponsors;

    public function __construct()
    {
        $this->sponsors = new ArrayCollection();
    }



    public function getIde(): ?int
    {
        return $this->ide;
    }

    public function getTypeEvent(): ?string
    {
        return $this->typeEvent;
    }

    public function setTypeEvent(string $typeEvent): self
    {
        $this->typeEvent = $typeEvent;

        return $this;
    }

    public function getChanteur(): ?string
    {
        return $this->chanteur;
    }

    public function setChanteur(string $chanteur): self
    {
        $this->chanteur = $chanteur;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDateEvent(): ?\DateTimeInterface
    {
        return $this->dateEvent;
    }

    public function setDateEvent(\DateTimeInterface $dateEvent): self
    {
        $this->dateEvent = $dateEvent;

        return $this;
    }

    public function getPrixE(): ?float
    {
        return $this->prixE;
    }

    public function setPrixE(float $prixE): self
    {
        $this->prixE = $prixE;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Sponsor>
     */
    public function getSponsors(): Collection
    {
        return $this->sponsors;
    }

    public function addSponsor(Sponsor $sponsor): self
    {
        if (!$this->sponsors->contains($sponsor)) {
            $this->sponsors[] = $sponsor;
        }

        return $this;
    }

    public function removeSponsor(Sponsor $sponsor): self
    {
        $this->sponsors->removeElement($sponsor);

        return $this;
    }



}
