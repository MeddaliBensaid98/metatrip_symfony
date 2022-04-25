<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationEvent
 *
 * @ORM\Table(name="reservation_event", indexes={@ORM\Index(name="Idrev", columns={"Idrev"}), @ORM\Index(name="Fk_eve", columns={"Ide"}), @ORM\Index(name="Fk_usr", columns={"Idu"})})
 * @ORM\Entity
 */
class ReservationEvent
{
    /**
     * @var int
     *
     * @ORM\Column(name="Idrev", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrev;

    /**
     * @var int
     *
     * @ORM\Column(name="Nb_pers", type="integer", nullable=false)
     */
    private $nbPers;

    /**
     * @var \Evenement
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Ide", referencedColumnName="Ide")
     * })
     */
    private $ide;

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
    public function getIdrev(): int
    {
        return $this->idrev;
    }

    /**
     * @param int $idrev
     */
    public function setIdrev(int $idrev): void
    {
        $this->idrev = $idrev;
    }

    /**
     * @return int
     */
    public function getNbPers(): int
    {
        return $this->nbPers;
    }

    /**
     * @param int $nbPers
     */
    public function setNbPers(int $nbPers): void
    {
        $this->nbPers = $nbPers;
    }

    /**
     * @return \Evenement
     */
    public function getIde(): \Evenement
    {
        return $this->ide;
    }

    /**
     * @param \Evenement $ide
     */
    public function setIde(\Evenement $ide): void
    {
        $this->ide = $ide;
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
