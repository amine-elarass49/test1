<?php

namespace App\Entity;

use App\Repository\EtatProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtatProduitRepository::class)
 */
class EtatProduit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $etat_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat_libelle;

    /**
     * @ORM\OneToMany(targetEntity=Produits::class, mappedBy="etat_id")
     */
    private $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getEtatId(): ?int
    {
        return $this->etat_id;
    }

    public function getEtatLibelle(): ?string
    {
        return $this->etat_libelle;
    }

    public function setEtatLibelle(string $etat_libelle): self
    {
        $this->etat_libelle = $etat_libelle;

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
            $produit->setEtatId($this);
        }

        return $this;
    }

    public function removeProduit(Produits $produit): self
    {
        if ($this->produits->contains($produit)) {
            $this->produits->removeElement($produit);
            // set the owning side to null (unless already changed)
            if ($produit->getEtatId() === $this) {
                $produit->setEtatId(null);
            }
        }

        return $this;
    }
}
