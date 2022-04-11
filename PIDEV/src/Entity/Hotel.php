<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hotel
 *
 * @ORM\Table(name="hotel")
 * @ORM\Entity
 */
class Hotel
{
    /**
     * @var int
     *
     * @ORM\Column(name="Idh", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idh;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_hotel", type="string", length=20, nullable=false)
     */
    private $nomHotel;

    /**
     * @var int
     *
     * @ORM\Column(name="Nb_etoiles", type="integer", nullable=false)
     */
    private $nbEtoiles;

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse", type="string", length=50, nullable=false)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=200, nullable=false)
     */
    private $image;

    /**
     * @return int
     */
    public function getIdh(): int
    {
        return $this->idh;
    }

    /**
     * @param int $idh
     */
    public function setIdh(int $idh): void
    {
        $this->idh = $idh;
    }

    /**
     * @return string
     */
    public function getNomHotel(): ?string
    {
        return $this->nomHotel;
    }

    /**
     * @param string $nomHotel
     */
    public function setNomHotel(string $nomHotel): void
    {
        $this->nomHotel = $nomHotel;
    }

    /**
     * @return int
     */
    public function getNbEtoiles(): ?int
    {
        return $this->nbEtoiles;
    }

    /**
     * @param int $nbEtoiles
     */
    public function setNbEtoiles(int $nbEtoiles): void
    {
        $this->nbEtoiles = $nbEtoiles;
    }

    /**
     * @return string
     */
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse(string $adresse): void
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function  __toString(){
        // to show the name of the Category in the select
        return $this->nomHotel;
        // to show the id of the Category in the select
        // return $this->id;
    }

}
