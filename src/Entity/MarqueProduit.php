<?php

namespace App\Entity;

use App\Repository\MarqueProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarqueProduitRepository::class)
 */
class MarqueProduit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $marque_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $marque_libelle;

    /**
     * @ORM\OneToMany(targetEntity=Produits::class, mappedBy="marque_id")
     */
    private $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getMarqueId(): ?int
    {
        return $this->marque_id;
    }

    public function getMarqueLibelle(): ?string
    {
        return $this->marque_libelle;
    }

    public function setMarqueLibelle(string $marque_libelle): self
    {
        $this->marque_libelle = $marque_libelle;

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
            $produit->setMarqueId($this);
        }

        return $this;
    }

    public function removeProduit(Produits $produit): self
    {
        if ($this->produits->contains($produit)) {
            $this->produits->removeElement($produit);
            // set the owning side to null (unless already changed)
            if ($produit->getMarqueId() === $this) {
                $produit->setMarqueId(null);
            }
        }

        return $this;
    }
}
