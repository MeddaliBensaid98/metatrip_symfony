<?php

namespace App\Entity;

namespace App\Entity;
use App\Entity\Voyage;
use App\Entity\VoyageOrganise;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Localisationvoyage
 *
 * @ORM\Table(name="localisationvoyage", indexes={@ORM\Index(name="FK_Voyage", columns={"Idv"})})
 * @ORM\Entity(repositoryClass="App\Repository\LocalisationvoyageRepository")
 */
class Localisationvoyage
{
    /**
     * @var int
     *
     * @ORM\Column(name="idl", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idl;

    /**
     * @var float
     * @ORM\Column(name="longitude", type="float", nullable=false)
      * @Assert\NotBlank
     */
    private $longitude;

   /**
     * @var float
     * @ORM\Column(name="latitude", type="float", nullable=false)
      * @Assert\NotBlank
     */
    private $latitude;

 

    /**
     * @var \Voyage
       * @Assert\NotBlank
     * @ORM\ManyToOne(targetEntity="Voyage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Idv", referencedColumnName="Idv")
     * })
     */
    private $idv;

   

    /**
     * Get the value of idl
     *
     * @return  int
     */ 
    public function getIdl()
    {
        return $this->idl;
    }

    /**
     * Set the value of idl
     *
     * @param  int  $idl
     *
     * @return  self
     */ 
    public function setIdl(int $idl)
    {
        $this->idl = $idl;

        return $this;
    }


    

    /**
     * Get the value of longitude
     *
     * @return  float
     */ 
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set the value of longitude
     *
     * @param  float  $longitude
     *
     * @return  self
     */ 
    public function setLongitude(float $longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get the value of latitude
     *
     * @return  float
     */ 
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set the value of latitude
     *
     * @param  float  $latitude
     *
     * @return  self
     */ 
    public function setLatitude(float $latitude)
    {
        $this->latitude = $latitude;

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