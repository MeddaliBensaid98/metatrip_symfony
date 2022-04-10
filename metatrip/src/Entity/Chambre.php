<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
    public $idc;

    /**
     * @var int
     *
     * @ORM\Column(name="numc", type="integer", nullable=false)
     */
    public $numc;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=1000, nullable=false)
     */
    public $image;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20, nullable=false)
     */
    public $type;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=40, nullable=false)
     */
    public $etat;

    /**
     * @var float|null
     *
     * @ORM\Column(name="prixc", type="float", precision=10, scale=0, nullable=true)
     */
    public $prixc;

    /**
     * @var \Hotel
     *
     * @ORM\ManyToOne(targetEntity="Hotel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idh", referencedColumnName="Idh")
     * })
     */
   public $idh;


}
