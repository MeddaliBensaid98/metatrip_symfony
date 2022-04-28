<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationVoiture
 *
 * @ORM\Table(name="reservation_voiture", indexes={@ORM\Index(name="FK_CHAUFF", columns={"idch"}), @ORM\Index(name="Idrvoit", columns={"Idrvoit"}), @ORM\Index(name="FK_resu", columns={"Idu"}), @ORM\Index(name="FK_resv", columns={"Idvoit"})})
 * @ORM\Entity
 */
class ReservationVoiture
{
    /**
     * @var int
     *
     * @ORM\Column(name="Idrvoit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrvoit;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_rent", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixRent;

    /**
     * @var string
     *
     * @ORM\Column(name="Trajet", type="string", length=20, nullable=false)
     */
    private $trajet;

    /**
     * @var \Chauffeur
     *
     * @ORM\ManyToOne(targetEntity="Chauffeur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idch", referencedColumnName="idch")
     * })
     */
    private $idch;

    /**
     * @var \Voiture
     *
     * @ORM\ManyToOne(targetEntity="Voiture")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Idvoit", referencedColumnName="Idvoit")
     * })
     */
    private $idvoit;

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
     * @return int
     */
    public function getIdrvoit(): int
    {
        return $this->idrvoit;
    }

    /**
     * @param int $idrvoit
     */
    public function setIdrvoit(int $idrvoit): void
    {
        $this->idrvoit = $idrvoit;
    }

    /**
     * @return float
     */
    public function getPrixRent(): ?float
    {
        return $this->prixRent;
    }

    /**
     * @param float $prixRent
     */
    public function setPrixRent(float $prixRent): void
    {
        $this->prixRent = $prixRent;
    }

    /**
     * @return string
     */
    public function getTrajet(): ?string
    {
        return $this->trajet;
    }

    /**
     * @param string $trajet
     */
    public function setTrajet(string $trajet): void
    {
        $this->trajet = $trajet;
    }


    public function getIdch(): ?Chauffeur
    {
        return $this->idch;
    }


    public function setIdch(?Chauffeur $idch): self
    {
        $this->idch = $idch;
        return $this;
    }


    public function getIdvoit(): ?Voiture
    {
        return $this->idvoit;
    }

    public function setIdvoit(?Voiture $idvoit): self
    {
        $this->idvoit = $idvoit;
        return $this;
    }


    public function getIdu(): ?User
    {
        return $this->idu;
    }

    public function setIdu(?User $idu): self
    {
        $this->idu = $idu;
        return $this;
    }
    public function  __toString(){
        // to show the name of the Category in the select
        return $this->trajet;
        // to show the id of the Category in the select
        // return $this->id;
    }

}
