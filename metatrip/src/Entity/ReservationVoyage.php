<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationVoyage
 *
 * @ORM\Table(name="reservation_voyage", indexes={@ORM\Index(name="FK_resvoy", columns={"Idv"}), @ORM\Index(name="FK_reusr", columns={"Idu"}), @ORM\Index(name="Idrv", columns={"Idrv"}), @ORM\Index(name="FKPAY", columns={"Ref_paiement"})})
 * @ORM\Entity
 */
class ReservationVoyage
{
    /**
     * @var int
     *
     * @ORM\Column(name="Idrv", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrv;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_depart", type="date", nullable=false)
     */
    private $dateDepart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_arrivee", type="date", nullable=false)
     */
    private $dateArrivee;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=20, nullable=false)
     */
    private $etat;

    /**
     * @var int
     *
     * @ORM\Column(name="Idu", type="integer", nullable=false)
     */
    private $idu;

    /**
     * @var int
     *
     * @ORM\Column(name="Ref_paiement", type="integer", nullable=false)
     */
    private $refPaiement = '0';

    /**
     * @var \Voyage
     *
     * @ORM\ManyToOne(targetEntity="Voyage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Idv", referencedColumnName="Idv")
     * })
     */
    private $idv;

    /**
     * @return int
     */
    public function getIdrv(): int
    {
        return $this->idrv;
    }

    /**
     * @param int $idrv
     */
    public function setIdrv(int $idrv): void
    {
        $this->idrv = $idrv;
    }

    /**
     * @return \DateTime
     */
    public function getDateDepart(): \DateTime
    {
        return $this->dateDepart;
    }

    /**
     * @param \DateTime $dateDepart
     */
    public function setDateDepart(\DateTime $dateDepart): void
    {
        $this->dateDepart = $dateDepart;
    }

    /**
     * @return \DateTime
     */
    public function getDateArrivee(): \DateTime
    {
        return $this->dateArrivee;
    }

    /**
     * @param \DateTime $dateArrivee
     */
    public function setDateArrivee(\DateTime $dateArrivee): void
    {
        $this->dateArrivee = $dateArrivee;
    }

    /**
     * @return string
     */
    public function getEtat(): string
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat(string $etat): void
    {
        $this->etat = $etat;
    }

    /**
     * @return int
     */
    public function getIdu(): int
    {
        return $this->idu;
    }

    /**
     * @param int $idu
     */
    public function setIdu(int $idu): void
    {
        $this->idu = $idu;
    }

    /**
     * @return int
     */
    public function getRefPaiement()
    {
        return $this->refPaiement;
    }

    /**
     * @param int $refPaiement
     */
    public function setRefPaiement($refPaiement): void
    {
        $this->refPaiement = $refPaiement;
    }

    /**
     * @return \Voyage
     */
    public function getIdv(): \Voyage
    {
        return $this->idv;
    }

    /**
     * @param \Voyage $idv
     */
    public function setIdv(\Voyage $idv): void
    {
        $this->idv = $idv;
    }


}
