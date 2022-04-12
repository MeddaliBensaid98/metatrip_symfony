<?php

namespace App\Entity;

use Serializable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Vich\UploaderBundle\Entity\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sponsor
 *
 * @Vich\Uploadable
 * @UniqueEntity("nomsponsor",message="nom sponsor est deja exist")
 * @ORM\Table(name="sponsor", indexes={@ORM\Index(name="sponsor_ibfk_1", columns={"ide"})})
 * @ORM\Entity
 */
class Sponsor
{
    /**
     * @var int
     *
     * @ORM\Column(name="ids", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ids;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="nomsponsor", type="string", length=20, nullable=false)
     */
    private $nomsponsor;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Length(min="8", minMessage="Votre cin doit faire minimum 8 caractères")
     * @ORM\Column(name="tel", type="string", length=20, nullable=false)
     */
    private $tel;

    /**
     * @var string
     * @Assert\NotBlank
     *
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     *
     * @ORM\Column(name="email", type="string", length=20, nullable=false)
     */
    private $email;

    /**
     * @var string
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

    /**
     * @var \DateTime
     * @Assert\NotBlank
     *
     * @ORM\Column(name="date_sp", type="date", nullable=false)
     */
    private $dateSp;

    /**
     * @var float
     * @Assert\NotBlank
     *
     * @Assert\Positive
     * @ORM\Column(name="prix_sp", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixSp;

    /**
     * @var \Evenement
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ide", referencedColumnName="Ide")
     * })
     */
    private $ide;

    public function getIds(): ?int
    {
        return $this->ids;
    }

    public function getNomsponsor(): ?string
    {
        return $this->nomsponsor;
    }

    public function setNomsponsor(string $nomsponsor): self
    {
        $this->nomsponsor = $nomsponsor;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }


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



    public function setImage( ?string $image ): self {
        $this->image = $image;

        return $this;
    }

    public function getDateSp(): ?\DateTimeInterface
    {
        return $this->dateSp;
    }

    public function setDateSp(\DateTimeInterface $dateSp): self
    {
        $this->dateSp = $dateSp;

        return $this;
    }

    public function getPrixSp(): ?float
    {
        return $this->prixSp;
    }

    public function setPrixSp(float $prixSp): self
    {
        $this->prixSp = $prixSp;

        return $this;
    }

    public function getIde(): ?Evenement
    {
        return $this->ide;
    }

    public function setIde(?Evenement $ide): self
    {
        $this->ide = $ide;

        return $this;
    }


}
