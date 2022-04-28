<?php
namespace App\Entity;
class PropertySearch
{
    private $chanteur;

    public function getChanteur(): ?string
    {
        return $this->chanteur;
    }
    public function setChanteur(string $chanteur): self
    {
        $this->chanteur = $chanteur;
        return $this;
    }



    private $typeEvent;


    public function getTypeEvent(): ?string
    {
        return $this->typeEvent;
    }
    public function setTypeEvent(string $typeEvent): self
    {
        $this->typeEvent = $typeEvent;
        return $this;
    }



}