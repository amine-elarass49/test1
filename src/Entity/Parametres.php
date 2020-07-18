<?php

namespace App\Entity;

use App\Repository\ParametresRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParametresRepository::class)
 */
class Parametres
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $par_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $par_param;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $par_valeur;

    public function getParId(): ?int
    {
        return $this->par_id;
    }

    public function getParParam(): ?string
    {
        return $this->par_param;
    }

    public function setParParam(string $par_param): self
    {
        $this->par_param = $par_param;

        return $this;
    }

    public function getParValeur(): ?string
    {
        return $this->par_valeur;
    }

    public function setParValeur(string $par_valeur): self
    {
        $this->par_valeur = $par_valeur;

        return $this;
    }
}
