<?php

namespace App\Entity;

use App\Repository\ProduitExtensionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\JoinColumn(name="produit" ,nullable=false,referencedColumnName="pr_id")
     */
    private $produits;

    /**
     * @ORM\OneToMany(targetEntity=Parametres::class, mappedBy="pr_ex_id")
     */
    private $parametres;

    public function __construct()
    {
        $this->parametres = new ArrayCollection();
    }

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

    /**
     * @return Collection|Parametres[]
     */
    public function getParametres(): Collection
    {
        return $this->parametres;
    }

    public function addParametre(Parametres $parametre): self
    {
        if (!$this->parametres->contains($parametre)) {
            $this->parametres[] = $parametre;
            $parametre->setPrExId($this);
        }

        return $this;
    }

    public function removeParametre(Parametres $parametre): self
    {
        if ($this->parametres->contains($parametre)) {
            $this->parametres->removeElement($parametre);
            // set the owning side to null (unless already changed)
            if ($parametre->getPrExId() === $this) {
                $parametre->setPrExId(null);
            }
        }

        return $this;
    }
}
