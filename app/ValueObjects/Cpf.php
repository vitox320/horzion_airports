<?php

namespace App\ValueObjects;

class Cpf
{
    private bool $isValidated;

    public function __construct(private readonly string $cpf)
    {
        $this->isValidated = false;
        $this->validate();
    }

    private function sanitize(): string
    {
        return preg_replace('/[^0-9]/', '', $this->cpf);
    }

    public function validate(): void
    {
        $cpf = $this->sanitize();
        if (preg_match('/^(\d)\1+$/', $cpf)) {
            throw new \InvalidArgumentException(message: 'CPF inválido', code: 422);
        }

        $sum = 0;

        for ($i = 0; $i < 9; $i++) {
            $sum += ($cpf[$i] * (10 - $i));
        }

        $remnant = $sum % 11;
        $firstNumber = ($remnant < 2) ? 0 : (11 - $remnant);

        $sum = 0;

        for ($i = 0; $i < 10; $i++) {
            $sum += ($cpf[$i] * (11 - $i));
        }

        $remnant = $sum % 11;
        $secondNumber = ($remnant < 2) ? 0 : (11 - $remnant);

        if ($cpf[9] != $firstNumber || $cpf[10] != $secondNumber) {
            throw new \InvalidArgumentException(message: 'CPF inválido', code: 422);
        }
        $this->isValidated = true;
    }

    public function getStatusValidationCpf(): bool
    {
        return $this->isValidated;
    }

    public function __toString(): string
    {
        return $this->sanitize();
    }


}
