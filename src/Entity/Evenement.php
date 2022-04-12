<?php

namespace App\Entity;

use Serializable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Vich\UploaderBundle\Entity\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\Image(
     *     minWidth = 250,
     *     maxWidth = 250,
     *     minHeight = 250,
     *     maxHeight = 250
     * )
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="Image")
     * @var string
     *
     * @Assert\Image(
     *     minWidth = 250,
     *     maxWidth = 250,
     *     minHeight = 250,
     *     maxHeight = 250
     * )
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
            $this->setUpdatedAt = new \DateTime('now');
        }

    }



    public function getImageFile()
    {
        return $this->imageFile;
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


}