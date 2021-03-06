<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Voyage;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * VoyageOrganise
 *
 * @ORM\Table(name="voyage_organise", indexes={@ORM\Index(name="FK_vo", columns={"Idv"})})
 * @ORM\Entity(repositoryClass="App\Repository\VoyageOrganiseRepository")
 */
class VoyageOrganise
{
    /**
     * @var int
     *
     * @ORM\Column(name="Idvo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idvo;

    /**
     * @var float
    *   @Assert\Positive  
     * @ORM\Column(name="Prix_billet", type="float", precision=10, scale=0, nullable=false)
      * @Assert\NotBlank
     */
    private $prixBillet;

    /**
     * @var string
       * @Assert\NotBlank
     * @ORM\Column(name="Airline", type="string", length=20, nullable=false)
     */
    private $airline;

    /**
     * @var int
        * @Assert\IsNull
     * @ORM\Column(name="Nb_nuitees", type="integer", nullable=false)
     */
    private $nbNuitees;

    /**
     * @var int
          * @Assert\NotBlank
    *   @Assert\Positive  
     * @ORM\Column(name="nbplaces", type="integer", nullable=false)
     */
    private $nbplaces;

    /**
     * @var string
       * @Assert\NotBlank
        *   @Assert\Positive  
     * @ORM\Column(name="etatVoyage", type="string", length=0, nullable=false)
     */
    private $etatvoyage;

    /**
     * @var \Voyage
       * @Assert\NotBlank
     * @ORM\ManyToOne(targetEntity="Voyage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Idv", referencedColumnName="Idv")
     * })
     */
    private $idv;

  
    public function getIdvo(): ?int
    {
        return $this->idvo;
    }

    public function getPrixBillet(): ?float
    {
        return $this->prixBillet;
    }

    public function setPrixBillet(float $prixBillet): self
    {
        $this->prixBillet = $prixBillet;

        return $this;
    }

    public function getAirline(): ?string
    {
        return $this->airline;
    }

    public function setAirline(string $airline): self
    {
        $this->airline = $airline;

        return $this;
    }

    public function getNbNuitees(): ?int
    {
        return $this->nbNuitees;
    }

    public function setNbNuitees(int $nbNuitees): self
    {
        $this->nbNuitees = $nbNuitees;

        return $this;
    }

    public function getNbplaces(): ?int
    {
        return $this->nbplaces;
    }

    public function setNbplaces(int $nbplaces): self
    {
        $this->nbplaces = $nbplaces;

        return $this;
    }

    public function getEtatvoyage(): ?string
    {
        return $this->etatvoyage;
    }

    public function setEtatvoyage(string $etatvoyage): self
    {
        $this->etatvoyage = $etatvoyage;

        return $this;
    }

    public function getIdv()
    {
        return $this->idv;
    }

    public function setIdv(?Voyage $idv): self
    {
        $this->idv = $idv;

        return $this;
    }


}