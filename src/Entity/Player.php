<?php

namespace App\Entity;


use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlayerRepository")
 * 
 * @UniqueEntity(fields={"name"}, message="Le nom d'utilisateur existe déja, veuillez en choisir un autre")
 */
class Player
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     *
     * @Assert\Length(min="2", max="50")
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @ORM\Column(type="integer")
     */
    private $victories;

    /**
     * @ORM\Column(type="integer")
     */
    private $fails;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationDate;

    public function __construct()
    {
        $this->creationDate = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function getVictories(): ?int
    {
        return $this->victories;
    }

    /**
     * @param mixed $victories
     */
    public function setVictories($victories): self
    {
        $this->victories = $victories;
        return $this;
    }

    public function getFails(): ?int
    {
        return $this->fails;
    }

    /**
     * @param mixed $fails
     */
    public function setFails($fails): self
    {
        $this->fails = $fails;
        return $this;
    }

    public function getCreationDate(): ?\DateTime
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate): self
    {
        $this->creationDate = $creationDate;
        return $this;
    }


}
