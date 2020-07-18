<?php

namespace App\Entity;

use App\Repository\GammeProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GammeProduitRepository::class)
 */
class GammeProduit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $gam_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gam_libelle;

    /**
     * @ORM\OneToMany(targetEntity=Produits::class, mappedBy="gamme_id")
     */
    private $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getGamId(): ?int
    {
        return $this->gam_id;
    }

    public function getGamLibelle(): ?string
    {
        return $this->gam_libelle;
    }

    public function setGamLibelle(string $gam_libelle): self
    {
        $this->gam_libelle = $gam_libelle;

        return $this;
    }

    /**
     * @return Collection|Produits[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produits $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setGammeId($this);
        }

        return $this;
    }

    public function removeProduit(Produits $produit): self
    {
        if ($this->produits->contains($produit)) {
            $this->produits->removeElement($produit);
            // set the owning side to null (unless already changed)
            if ($produit->getGammeId() === $this) {
                $produit->setGammeId(null);
            }
        }

        return $this;
    }
}
