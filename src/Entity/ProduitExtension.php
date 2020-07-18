<?php

namespace App\Entity;

use App\Repository\ProduitExtensionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitExtensionRepository::class)
 */
class ProduitExtension
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $pr_ex_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pr_ex_valeur;

    /**
     * @ORM\ManyToOne(targetEntity=Produits::class, inversedBy="pr_ex_id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produits;

    public function getParExId(): ?int
    {
        return $this->par_ex_id;
    }

    public function getPrExValeur(): ?string
    {
        return $this->pr_ex_valeur;
    }

    public function setPrExValeur(string $pr_ex_valeur): self
    {
        $this->pr_ex_valeur = $pr_ex_valeur;

        return $this;
    }

    public function getProduits(): ?Produits
    {
        return $this->produits;
    }

    public function setProduits(?Produits $produits): self
    {
        $this->produits = $produits;

        return $this;
    }
}
