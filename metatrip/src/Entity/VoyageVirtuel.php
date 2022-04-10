<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VoyageVirtuel
 *
 * @ORM\Table(name="voyage_virtuel", indexes={@ORM\Index(name="FK_abb", columns={"Ida"}), @ORM\Index(name="FK_vv", columns={"Idv"})})
 * @ORM\Entity
 */
class VoyageVirtuel
{
    /**
     * @var int
     *
     * @ORM\Column(name="Idvv", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idvv;

    /**
     * @var string
     *
     * @ORM\Column(name="Video", type="string", length=50, nullable=false)
     */
    private $video;

    /**
     * @var string
     *
     * @ORM\Column(name="Image_v", type="string", length=50, nullable=false)
     */
    private $imageV;

    /**
     * @var \Abonnement
     *
     * @ORM\ManyToOne(targetEntity="Abonnement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Ida", referencedColumnName="Ida")
     * })
     */
    private $ida;

    /**
     * @var \Voyage
     *
     * @ORM\ManyToOne(targetEntity="Voyage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Idv", referencedColumnName="Idv")
     * })
     */
    private $idv;


}
