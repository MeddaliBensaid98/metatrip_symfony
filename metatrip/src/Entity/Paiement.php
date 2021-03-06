<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paiement
 *
 * @ORM\Table(name="paiement")
 * @ORM\Entity
 */
class Paiement
{
    /**
     * @var int
     *
     * @ORM\Column(name="Ref_paiement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $refPaiement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_paiement", type="date", nullable=false)
     */
    private $datePaiement;

    public function getRefPaiement(): ?int
    {
        return $this->refPaiement;
    }

    public function getDatePaiement(): ?\DateTimeInterface
    {
        return $this->datePaiement;
    }

    public function setDatePaiement(\DateTimeInterface $datePaiement): self
    {
        $this->datePaiement = $datePaiement;

        return $this;
    }
    public function  __toString(){
        // to show the name of the Category in the select
        return $this->refPaiement;
        // to show the id of the Category in the select
        // return $this->id;
    }

}
