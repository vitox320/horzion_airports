<?php

namespace Tests\Unit;

use App\ValueObjects\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testIfAnInvalidEmailCanBeInvalidated(): void
    {

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage('Email Inválido');
        new Email('teste.com.br');
    }

    public function testIfAValidEmailCanBeValidated(): void
    {
        $email = new Email('teste@gmail.com');
        $this->assertTrue($email->getStatusValidationEmail());

    }
}
