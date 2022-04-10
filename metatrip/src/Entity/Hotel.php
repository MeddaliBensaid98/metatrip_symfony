<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hotel
 *
 * @ORM\Table(name="hotel")
 * @ORM\Entity
 */
class Hotel
{
    /**
     * @var int
     *
     * @ORM\Column(name="Idh", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $idh;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_hotel", type="string", length=20, nullable=false)
     */
    public $nomHotel;

    /**
     * @var int
     *
     * @ORM\Column(name="Nb_etoiles", type="integer", nullable=false)
     */
    public $nbEtoiles;

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse", type="string", length=50, nullable=false)
     */
    public $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=200, nullable=false)
     */
   public $image;


}
