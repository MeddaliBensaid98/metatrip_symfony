<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Serializable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use DateTime;
use Vich\UploaderBundle\Entity\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

use Symfony\Component\Validator\Constraints as Assert;

use DateTimeInterface;


/**
 * Evenement
 * @Vich\Uploadable
 * @ORM\Table(name="evenement")
 * @ORM\Entity
 */
class Evenement
{
    /**
     * @var int
     *
     * @ORM\Column(name="Ide", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ide;

    /**
     * @var string
     *
     * @ORM\Column(name="Type_event", type="string", length=20, nullable=false)
     */
    private $typeEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="Chanteur", type="string", length=20, nullable=false)
     */
    private $chanteur;

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse", type="string", length=20, nullable=false)
     */
    private $adresse;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_event", type="date", nullable=false)
     */
    private $dateEvent;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dateEnd", type="date", nullable=true)
     */
    private $dateend;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_e", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixE;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;

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

    public function getDateend(): ?\DateTimeInterface
    {
        return $this->dateend;
    }

    public function setDateend(\DateTimeInterface $dateend): self
    {
        $this->dateend = $dateend;

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
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="Image")
     * @var File
     */
    private $imageFile;


    public function setImageFile( $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }


    /**
     * @ORM\ManyToMany(targetEntity=Sponsor::class, inversedBy="evenements")
     */
    private $sponsors;


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
