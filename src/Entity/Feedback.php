<?php

namespace App\Entity;

class Feedback
{
    /** @var int|null */
    private ?int $id = null;

    /** @var string */
    private string $name;

    /** @var int */
    private int $phone;

    /** @var string */
    private string $message;

    public function __construct(?int $id, string $name, int $phone, string $message)
    {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->message = $message;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhone(): int
    {
        return $this->phone;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}