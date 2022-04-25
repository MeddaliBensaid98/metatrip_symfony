<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * VoyageVirtuel
 *
 * @ORM\Table(name="voyage_virtuel", indexes={@ORM\Index(name="FK_abb", columns={"Ida"}), @ORM\Index(name="FK_vv", columns={"Idv"})})
 * @ORM\Entity
 */
class VoyageVirtuel
{
    /**
     * @var int
     *
     * @ORM\Column(name="Idvv", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")

     */
    private $idvv;

    /**
     * @var string
     *
     * @ORM\Column(name="Video", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Video path is required")
     * @Assert\Length(
     *      min = 5,
     *      max = 50,
     *      minMessage = "Id video must be at least {{ limit }} characters long",
     *      maxMessage = "Id video cannot be longer than {{ limit }} characters"
     * )
     */
    private $video;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Nom  is required")

     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Image_v", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Image path is required")
     */
    private $imageV;

    /**
     * @var \Abonnement
     *
     * @ORM\ManyToOne(targetEntity="Abonnement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Ida", referencedColumnName="Ida")
     * })
     */
    private $ida;

    /**
     * @var \Voyage
     *
     * @ORM\ManyToOne(targetEntity="Voyage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Idv", referencedColumnName="Idv")
     * })
     */
    private $idv;

    public function getIdvv(): ?int
    {
        return $this->idvv;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(string $video): self
    {
        $this->video = $video;

        return $this;
    }
    public function getNom(): ?string
    {
        return $this->nom;
    }
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getImageV(): ?string
    {
        return $this->imageV;
    }

    public function setImageV(string $imageV): self
    {
        $this->imageV = $imageV;

        return $this;
    }

    public function getIda(): ?Abonnement
    {
        return $this->ida;
    }

    public function setIda(?Abonnement $ida): self
    {
        $this->ida = $ida;

        return $this;
    }

    public function getIdv(): ?Voyage
    {
        return $this->idv;
    }

    public function setIdv(?Voyage $idv): self
    {
        $this->idv = $idv;

        return $this;
    }
    public function  __toString(){
        // to show the name of the Category in the select
        return $this->video;
        // to show the id of the Category in the select
        // return $this->id;
    }

}
