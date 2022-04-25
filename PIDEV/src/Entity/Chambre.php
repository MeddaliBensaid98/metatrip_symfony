<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Chambre
 *
 * @ORM\Table(name="chambre", indexes={@ORM\Index(name="idc", columns={"idc"}), @ORM\Index(name="idh", columns={"idh"})})
 * @ORM\Entity
 */
class Chambre
{
    /**
     * @var int
     *
     * @ORM\Column(name="idc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idc;

    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Positive 
     * @ORM\Column(name="numc", type="integer", nullable=false)
     * 
     */
    private $numc;

    /**
     * @var string
     * @ORM\Column(name="image", type="string", length=1000, nullable=false)
     */
    private $image;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="type", type="string", length=20, nullable=false)
     */
    private $type;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="etat", type="string", length=40, nullable=false)
     */
    private $etat;

    /**
     * @var float|null
     *  @Assert\NotBlank
     *
     * @ORM\Column(name="prixc", type="float", precision=10, scale=0, nullable=true, options={"default"="NULL"})
     * @Assert\Positive 
     */
    private $prixc = NULL;

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
    public function getIdc(): ?int
    {
        return $this->idc;
    }

    /**
     * @param int $idc
     */
    public function setIdc(int $idc): void
    {
        $this->idc = $idc;
    }

    /**
     * @return int
     */
    public function getNumc(): ?int
    {
        return $this->numc;
    }

    /**
     * @param int $numc
     */
    public function setNumc(int $numc): void
    {
        $this->numc = $numc;
    }

    /**
     * @return string
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getEtat(): ?string
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
     * @return float|null
     */
    public function getPrixc(): ?float
    {
        return $this->prixc;
    }

    /**
     * @param float|null $prixc
     */
    public function setPrixc(?float $prixc): void
    {
        $this->prixc = $prixc;
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
    public function setIdh(\Hotel $idh): void
    {
        $this->idh = $idh;
    }
    public function  __toString(){
        // to show the name of the Category in the select
        return $this->hotel;
        // to show the id of the Category in the select
        // return $this->id;
    }

}
