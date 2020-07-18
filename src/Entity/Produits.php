<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitsRepository::class)
 */
class Produits
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $pr_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pr_nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pr_ref;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pr_desc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pr_image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pr_desc_int;

    /**
     * @ORM\ManyToOne(targetEntity=EtatProduit::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etat_id;

    /**
     * @ORM\ManyToOne(targetEntity=TypeProduit::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type_id;

    /**
     * @ORM\ManyToMany(targetEntity=UniteMesure::class, inversedBy="produits")
     */
    private $um_id;

    /**
     * @ORM\ManyToOne(targetEntity=gammeProduit::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $gamme_id;

    /**
     * @ORM\ManyToOne(targetEntity=MarqueProduit::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $marque_id;

    /**
     * @ORM\OneToMany(targetEntity=ProduitExtension::class, mappedBy="produits")
     */
    private $pr_ex_id;

    public function __construct()
    {
        $this->um_id = new ArrayCollection();
        $this->pr_ex_id = new ArrayCollection();
    }

    public function getPrId(): ?int
    {
        return $this->pr_id;
    }

    public function getPrNom(): ?string
    {
        return $this->pr_nom;
    }

    public function setPrNom(string $pr_nom): self
    {
        $this->pr_nom = $pr_nom;

        return $this;
    }

    public function getPrRef(): ?string
    {
        return $this->pr_ref;
    }

    public function setPrRef(string $pr_ref): self
    {
        $this->pr_ref = $pr_ref;

        return $this;
    }

    public function getPrDesc(): ?string
    {
        return $this->pr_desc;
    }

    public function setPrDesc(string $pr_desc): self
    {
        $this->pr_desc = $pr_desc;

        return $this;
    }

    public function getPrImage(): ?string
    {
        return $this->pr_image;
    }

    public function setPrImage(string $pr_image): self
    {
        $this->pr_image = $pr_image;

        return $this;
    }

    public function getPrDescInt(): ?string
    {
        return $this->pr_desc_int;
    }

    public function setPrDescInt(string $pr_desc_int): self
    {
        $this->pr_desc_int = $pr_desc_int;

        return $this;
    }

    public function getEtatId(): ?EtatProduit
    {
        return $this->etat_id;
    }

    public function setEtatId(?EtatProduit $etat_id): self
    {
        $this->etat_id = $etat_id;

        return $this;
    }

    public function getTypeId(): ?TypeProduit
    {
        return $this->type_id;
    }

    public function setTypeId(?TypeProduit $type_id): self
    {
        $this->type_id = $type_id;

        return $this;
    }

    /**
     * @return Collection|UniteMesure[]
     */
    public function getUmId(): Collection
    {
        return $this->um_id;
    }

    public function addUmId(UniteMesure $umId): self
    {
        if (!$this->um_id->contains($umId)) {
            $this->um_id[] = $umId;
        }

        return $this;
    }

    public function removeUmId(UniteMesure $umId): self
    {
        if ($this->um_id->contains($umId)) {
            $this->um_id->removeElement($umId);
        }

        return $this;
    }

    public function getGammeId(): ?gammeProduit
    {
        return $this->gamme_id;
    }

    public function setGammeId(?gammeProduit $gamme_id): self
    {
        $this->gamme_id = $gamme_id;

        return $this;
    }

    public function getMarqueId(): ?MarqueProduit
    {
        return $this->marque_id;
    }

    public function setMarqueId(?MarqueProduit $marque_id): self
    {
        $this->marque_id = $marque_id;

        return $this;
    }

    /**
     * @return Collection|ProduitExtension[]
     */
    public function getPrExId(): Collection
    {
        return $this->pr_ex_id;
    }

    public function addPrExId(ProduitExtension $prExId): self
    {
        if (!$this->pr_ex_id->contains($prExId)) {
            $this->pr_ex_id[] = $prExId;
            $prExId->setProduits($this);
        }

        return $this;
    }

    public function removePrExId(ProduitExtension $prExId): self
    {
        if ($this->pr_ex_id->contains($prExId)) {
            $this->pr_ex_id->removeElement($prExId);
            // set the owning side to null (unless already changed)
            if ($prExId->getProduits() === $this) {
                $prExId->setProduits(null);
            }
        }

        return $this;
    }
}
