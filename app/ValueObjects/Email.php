<?php

namespace App\ValueObjects;

class Email
{
    private bool $isValidated;

    public function __construct(private readonly string $email)
    {
        $this->isValidated = false;
        $this->verifyIfEmailIsValid();
    }

    public function verifyIfEmailIsValid(): void
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException(message: 'Email Inválido', code: 422);
        }
        $this->isValidated = true;
    }

    public function getStatusValidationEmail(): bool
    {
        return $this->isValidated;
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
