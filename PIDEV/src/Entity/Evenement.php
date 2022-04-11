<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity
 */
class Evenement
{
    /**
     * @var int
     *
     * @ORM\Column(name="Ide", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ide;

    /**
     * @var string
     *
     * @ORM\Column(name="Type_event", type="string", length=20, nullable=false)
     */
    private $typeEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="Chanteur", type="string", length=20, nullable=false)
     */
    private $chanteur;

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse", type="string", length=20, nullable=false)
     */
    private $adresse;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_event", type="date", nullable=false)
     */
    private $dateEvent;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_e", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixE;

    /**
     * @return int
     */
    public function getIde(): int
    {
        return $this->ide;
    }

    /**
     * @param int $ide
     */
    public function setIde(int $ide): void
    {
        $this->ide = $ide;
    }

    /**
     * @return string
     */
    public function getTypeEvent(): string
    {
        return $this->typeEvent;
    }

    /**
     * @param string $typeEvent
     */
    public function setTypeEvent(string $typeEvent): void
    {
        $this->typeEvent = $typeEvent;
    }

    /**
     * @return string
     */
    public function getChanteur(): string
    {
        return $this->chanteur;
    }

    /**
     * @param string $chanteur
     */
    public function setChanteur(string $chanteur): void
    {
        $this->chanteur = $chanteur;
    }

    /**
     * @return string
     */
    public function getAdresse(): string
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
     * @return \DateTime
     */
    public function getDateEvent(): \DateTime
    {
        return $this->dateEvent;
    }

    /**
     * @param \DateTime $dateEvent
     */
    public function setDateEvent(\DateTime $dateEvent): void
    {
        $this->dateEvent = $dateEvent;
    }

    /**
     * @return float
     */
    public function getPrixE(): float
    {
        return $this->prixE;
    }

    /**
     * @param float $prixE
     */
    public function setPrixE(float $prixE): void
    {
        $this->prixE = $prixE;
    }


}
