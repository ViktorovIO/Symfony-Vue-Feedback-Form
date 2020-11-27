<?php

namespace App\Feedback;

class Feedback
{
    private int $id;

    private string $name;

    private int $phone;

    private string $message;

    public function __construct(int $id, string $name, int $phone, string $message)
    {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->message = $message;
    }

    public function getId(): int
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
}
