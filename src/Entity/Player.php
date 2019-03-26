<?php

declare(strict_types=1);


namespace App\Entity;


class Player
{
    /**
     * @var int
     *
     *
     */
    private $id;

    /** @var string */
    private $name;

    /** @var int */
    private $amount;

    public function __construct(string $name, int $amount)
    {
        $this->name = $name;
        $this->amount = $amount;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
}
