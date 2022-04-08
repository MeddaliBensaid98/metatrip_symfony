<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Localisationvoyage
 *
 * @ORM\Table(name="localisationvoyage", indexes={@ORM\Index(name="idv", columns={"idv"})})
 * @ORM\Entity
 */
class Localisationvoyage
{
    /**
     * @var int
     *
     * @ORM\Column(name="Idlocalisation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlocalisation;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", precision=10, scale=0, nullable=false)
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", precision=10, scale=0, nullable=false)
     */
    private $longitude;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idv", type="integer", nullable=true)
     */
    private $idv;

    public function getIdlocalisation(): ?int
    {
        return $this->idlocalisation;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getIdv(): ?int
    {
        return $this->idv;
    }

    public function setIdv(?int $idv): self
    {
        $this->idv = $idv;

        return $this;
    }


}
