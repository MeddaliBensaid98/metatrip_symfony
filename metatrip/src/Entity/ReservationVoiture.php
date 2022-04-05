<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationVoiture
 *
 * @ORM\Table(name="reservation_voiture", indexes={@ORM\Index(name="FK_resv", columns={"Idvoit"}), @ORM\Index(name="FK_CHAUFF", columns={"idch"}), @ORM\Index(name="Idrvoit", columns={"Idrvoit"}), @ORM\Index(name="FK_resu", columns={"Idu"})})
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
     * @var int
     *
     * @ORM\Column(name="Idu", type="integer", nullable=false)
     */
    private $idu;

    /**
     * @var int
     *
     * @ORM\Column(name="Idvoit", type="integer", nullable=false)
     */
    private $idvoit;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idch", type="integer", nullable=true)
     */
    private $idch;

    public function getIdrvoit(): ?int
    {
        return $this->idrvoit;
    }

    public function getPrixRent(): ?float
    {
        return $this->prixRent;
    }

    public function setPrixRent(float $prixRent): self
    {
        $this->prixRent = $prixRent;

        return $this;
    }

    public function getTrajet(): ?string
    {
        return $this->trajet;
    }

    public function setTrajet(string $trajet): self
    {
        $this->trajet = $trajet;

        return $this;
    }

    public function getIdu(): ?int
    {
        return $this->idu;
    }

    public function setIdu(int $idu): self
    {
        $this->idu = $idu;

        return $this;
    }

    public function getIdvoit(): ?int
    {
        return $this->idvoit;
    }

    public function setIdvoit(int $idvoit): self
    {
        $this->idvoit = $idvoit;

        return $this;
    }

    public function getIdch(): ?int
    {
        return $this->idch;
    }

    public function setIdch(?int $idch): self
    {
        $this->idch = $idch;

        return $this;
    }


}
