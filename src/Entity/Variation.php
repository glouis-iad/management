<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\VariationRepository")
 */
class Variation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     * @Assert\NotBlank(
     *     message="Nom de Variant est invalide")
     * @Groups({"public", "allowPosted"})
     */
    private $value;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     * @Assert\NotBlank(
     *      message = "Prix d'achat est invalide",
     * )
     * @Groups({"public", "allowPosted"})
     */
    private $basePrice;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     * @Assert\NotBlank(
     *      message = "Prix de vente est invalide",
     * )
     * @Groups({"public", "allowPosted"})
     */
    private $sellPrice;

    /**
     * @ORM\Column(type="digit", nullable=true)
     * @Assert\Type(type="numeric", message="Quantité invalide.")
     * @Assert\Positive(message = "Quantité doit être supérieure de 0")
     * @Assert\NotBlank(
     *      message = "Quantité ne doit pas être vide",
     * )
     * @Groups({"public", "allowPosted"})
     */
    private $quantity;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="variations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return Variation
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBasePrice()
    {
        return $this->basePrice;
    }

    /**
     * @param mixed $basePrice
     * @return Variation
     */
    public function setBasePrice($basePrice)
    {
        $this->basePrice = $basePrice;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSellPrice()
    {
        return $this->sellPrice;
    }

    /**
     * @param mixed $sellPrice
     * @return Variation
     */
    public function setSellPrice($sellPrice)
    {
        $this->sellPrice = $sellPrice;
        return $this;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity): self
    {
        $this->quantity = !empty($quantity) ? $quantity : 0;
        return $this;
    }


}
