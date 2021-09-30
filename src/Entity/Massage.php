<?php

namespace App\Entity;

use App\Repository\MassageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MassageRepository::class)
 */
class Massage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price1;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price2;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price3;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price4;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $images;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pression;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPrice1(): ?float
    {
        return $this->price1;
    }

    public function setPrice1(?float $price1): self
    {
        $this->price1 = $price1;

        return $this;
    }

    public function getPrice2(): ?float
    {
        return $this->price2;
    }

    public function setPrice2(?float $price2): self
    {
        $this->price2 = $price2;

        return $this;
    }

    public function getPrice3(): ?float
    {
        return $this->price3;
    }

    public function setPrice3(?float $price3): self
    {
        $this->price3 = $price3;

        return $this;
    }

    public function getPrice4(): ?float
    {
        return $this->price4;
    }

    public function setPrice4(?float $price4): self
    {
        $this->price4 = $price4;

        return $this;
    }

    public function getImages(): ?string
    {
        return $this->images;
    }

    public function setImages(string $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPression(): ?string
    {
        return $this->pression;
    }

    public function setPression(string $pression): self
    {
        $this->pression = $pression;

        return $this;
    }
}
