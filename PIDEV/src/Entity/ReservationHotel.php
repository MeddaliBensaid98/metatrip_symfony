<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationHotel
 *
 * @ORM\Table(name="reservation_hotel", indexes={@ORM\Index(name="Idrh", columns={"Idrh"}), @ORM\Index(name="FK_u", columns={"Idu"}), @ORM\Index(name="kk_h", columns={"idh"})})
 * @ORM\Entity
 */
class ReservationHotel
{
    /**
     * @var int
     *
     * @ORM\Column(name="Idrh", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrh;

    /**
     * @var int
     *
     * @ORM\Column(name="Nb_nuitees", type="integer", nullable=false)
     */
    private $nbNuitees;

    /**
     * @var int
     *
     * @ORM\Column(name="Nb_personnes", type="integer", nullable=false)
     */
    private $nbPersonnes;

    /**
     * @var float
     *
     * @ORM\Column(name="Prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_depart", type="date", nullable=true, options={"default"="NULL"})
     */
    private $dateDepart ;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_arrivee", type="date", nullable=true, options={"default"="NULL"})
     */
    private $dateArrivee;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Idu", referencedColumnName="Idu")
     * })
     */
    private $idu;

    /**
     * @var \Hotel
     *
     * @ORM\ManyToOne(targetEntity="Hotel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idh", referencedColumnName="Idh")
     * })
     */
    private $idh;

    /**
     * @return int
     */
    public function getIdrh(): ?int
    {
        return $this->idrh;
    }

    /**
     * @param int $idrh
     */
    public function setIdrh(int $idrh): void
    {
        $this->idrh = $idrh;
    }

    /**
     * @return int
     */
    public function getNbNuitees(): ?int
    {
        return $this->nbNuitees;
    }

    /**
     * @param int $nbNuitees
     */
    public function setNbNuitees(int $nbNuitees): void
    {
        $this->nbNuitees = $nbNuitees;
    }

    /**
     * @return int
     */
    public function getNbPersonnes(): ?int
    {
        return $this->nbPersonnes;
    }

    /**
     * @param int $nbPersonnes
     */
    public function setNbPersonnes(int $nbPersonnes): void
    {
        $this->nbPersonnes = $nbPersonnes;
    }

    /**
     * @return float
     */
    public function getPrix(): ?float
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     */
    public function setPrix(float $prix): void
    {
        $this->prix = $prix;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateDepart()
    {
        return $this->dateDepart;
    }

    /**
     * @param \DateTime|null $dateDepart
     */
    public function setDateDepart($dateDepart): void
    {
        $this->dateDepart = $dateDepart;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateArrivee()
    {
        return $this->dateArrivee;
    }

    /**
     * @param \DateTime|null $dateArrivee
     */
    public function setDateArrivee($dateArrivee): void
    {
        $this->dateArrivee = $dateArrivee;
    }

    /**
     * @return \User
     */
    public function getIdu(): ?User
    {
        return $this->idu;
    }

    /**
     * @param \User $idu
     */
    public function setIdu(?User $idu): self
    {
        $this->idu = $idu;
        return $this;

    }

    /**
     * @return \Hotel
     */
    public function getIdh(): ?Hotel
    {
        return $this->idh;
    }

    /**
     * @param \Hotel $idh
     */
    public function setIdh(?Hotel $idh): self
    {
        $this->idh = $idh;
        return $this;

    }
    public function  __toString(){
        // to show the name of the Category in the select
        return $this->User;
        // to show the id of the Category in the select
        // return $this->id;
    }


}
