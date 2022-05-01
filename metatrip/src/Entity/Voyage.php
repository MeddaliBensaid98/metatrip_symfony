<?php

namespace App\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Voyage
 *
 * @ORM\Table(name="voyage")
 * @ORM\Entity
 *  @UniqueEntity("pays",message="pays est deja exist") 
 *  @Vich\Uploadable
 */
class Voyage
{
    /**
     * @var int
     *
     * @ORM\Column(name="Idv", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idv;

    /**
     * @var string
       * @Assert\NotBlank
     * @ORM\Column(name="Pays", type="string", length=20, nullable=false)
     */
    private $pays;

    
    /**
     * @var string
     *
     * @ORM\Column(name="Image_Pays", type="string", length=40, nullable=false)
   
     */
    private $imagePays;

      /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="Image_Pays")
     * @var File
     */
    private $imageFile;

    public function getIdv(): ?int
    {
        return $this->idv;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getImagePays()
    {
        return $this->imagePays;
    }

    public function setImagePays($imagePays)
    {
        $this->imagePays = $imagePays;

        return $this;
    }

    public function  __toString(){
        // to show the name of the Category in the select
        return $this->pays;
        // to show the id of the Category in the select
        // return $this->id;
    }
    public function setImageFile( $image )
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
      
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

}