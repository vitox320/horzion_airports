<?php

namespace Tests\Unit;

use App\ValueObjects\Cpf;
use PHPUnit\Framework\TestCase;

class CpfTest extends TestCase
{

    public function testIfACpfValidCanBeSanitized()
    {
        $cpf = new Cpf('892.593.880-40');
        $this->assertEquals('89259388040', (string)$cpf);
    }

    public function testIfACpfValidCanBeValidated()
    {
        $cpf = new Cpf('892.593.880-40');
        $this->assertTrue($cpf->getStatusValidationCpf());
    }

    public function testIfACpfInvalidCanBeInvalidated()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionCode(422);
        $this->expectExceptionMessage('CPF inválido');
        new Cpf('051-965-845-88');
    }
}
