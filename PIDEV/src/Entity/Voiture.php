<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Voiture
 *
 * @ORM\Table(name="voiture", indexes={@ORM\Index(name="Idvoit", columns={"Idvoit"})})
 * @ORM\Entity
 */
class Voiture
{
    /**
     * @var int
     *
     * @ORM\Column(name="Idvoit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idvoit;

    /**
     * @var string
     *
     * @ORM\Column(name="Matricule", type="string", length=50, nullable=false)
     */
    private $matricule;

    /**
     * @var int
     *
     * @ORM\Column(name="Puissance_fiscalle", type="integer", nullable=false)
     */
    private $puissanceFiscalle;

    /**
     * @var string
     *
     * @ORM\Column(name="Image_v", type="string", length=50, nullable=false)
     */
    private $imageV;

    /**
     * @var string
     *
     * @ORM\Column(name="Modele", type="string", length=20, nullable=false)
     */
    private $modele;

    /**
     * @return int
     */
    public function getIdvoit(): ?int
    {
        return $this->idvoit;
    }

    /**
     * @param int $idvoit
     */
    public function setIdvoit(int $idvoit): void
    {
        $this->idvoit = $idvoit;
    }

    /**
     * @return string
     */
    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    /**
     * @param string $matricule
     */
    public function setMatricule(string $matricule): void
    {
        $this->matricule = $matricule;
    }

    /**
     * @return int
     */
    public function getPuissanceFiscalle(): ?int
    {
        return $this->puissanceFiscalle;
    }

    /**
     * @param int $puissanceFiscalle
     */
    public function setPuissanceFiscalle(int $puissanceFiscalle): void
    {
        $this->puissanceFiscalle = $puissanceFiscalle;
    }

    /**
     * @return string
     */
    public function getImageV(): ?string
    {
        return $this->imageV;
    }

    /**
     * @param string $imageV
     */
    public function setImageV(string $imageV): void
    {
        $this->imageV = $imageV;
    }

    /**
     * @return string
     */
    public function getModele(): ?string
    {
        return $this->modele;
    }

    /**
     * @param string $modele
     */
    public function setModele(string $modele): void
    {
        $this->modele = $modele;
    }
    public function  __toString(){
        // to show the name of the Category in the select
        return $this->modele;
        // to show the id of the Category in the select
        // return $this->id;
    }

}
