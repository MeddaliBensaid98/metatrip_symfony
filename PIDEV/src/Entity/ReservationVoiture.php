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

    /**
     * @return \Chauffeur
     */
    public function getIdch(): \Chauffeur
    {
        return $this->idch;
    }

    /**
     * @param \Chauffeur $idch
     */
    public function setIdch(\Chauffeur $idch): void
    {
        $this->idch = $idch;
    }

    /**
     * @return \Voiture
     */
    public function getIdvoit(): \Voiture
    {
        return $this->idvoit;
    }

    /**
     * @param \Voiture $idvoit
     */
    public function setIdvoit(\Voiture $idvoit): void
    {
        $this->idvoit = $idvoit;
    }

    /**
     * @return \User
     */
    public function getIdu(): \User
    {
        return $this->idu;
    }

    /**
     * @param \User $idu
     */
    public function setIdu(\User $idu): void
    {
        $this->idu = $idu;
    }


}
