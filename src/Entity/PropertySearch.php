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



}