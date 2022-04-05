<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationEvent
 *
 * @ORM\Table(name="reservation_event", indexes={@ORM\Index(name="Fk_usr", columns={"Idu"}), @ORM\Index(name="Idrev", columns={"Idrev"}), @ORM\Index(name="Fk_eve", columns={"Ide"})})
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
     * @var int
     *
     * @ORM\Column(name="Ide", type="integer", nullable=false)
     */
    private $ide;

    /**
     * @var int
     *
     * @ORM\Column(name="Idu", type="integer", nullable=false)
     */
    private $idu;

    public function getIdrev(): ?int
    {
        return $this->idrev;
    }

    public function getNbPers(): ?int
    {
        return $this->nbPers;
    }

    public function setNbPers(int $nbPers): self
    {
        $this->nbPers = $nbPers;

        return $this;
    }

    public function getIde(): ?int
    {
        return $this->ide;
    }

    public function setIde(int $ide): self
    {
        $this->ide = $ide;

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


}
