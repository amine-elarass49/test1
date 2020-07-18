<?php

namespace App\Entity;

use App\Repository\UniteMesureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UniteMesureRepository::class)
 */
class UniteMesure
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $um_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $um_libelle;

    /**
     * @ORM\ManyToMany(targetEntity=Produits::class, mappedBy="um_id")
     * @ORM\JoinTable(
     * joinColumns={@ORM\JoinColumn(referencedColumnName="um_id")},
     * inverseJoinColumns={@ORM\JoinColumn(referencedColumnName="pr_id")}
     * )
     */
    private $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getUmId(): ?int
    {
        return $this->um_id;
    }

    public function getUmLibelle(): ?string
    {
        return $this->um_libelle;
    }

    public function setUmLibelle(string $um_libelle): self
    {
        $this->um_libelle = $um_libelle;

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
            $produit->addUmId($this);
        }

        return $this;
    }

    public function removeProduit(Produits $produit): self
    {
        if ($this->produits->contains($produit)) {
            $this->produits->removeElement($produit);
            $produit->removeUmId($this);
        }

        return $this;
    }
}
