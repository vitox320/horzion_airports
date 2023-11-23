<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class UserTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        DB::beginTransaction();

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
    }

    public function testIfUserCanLogin(): void
    {
        $requestData = [
            'email' => 'gestor1@gmail.com',
            'password' => '123456'
        ];
        $response = $this->post('/api/auth/login', $requestData);
        $response->assertSee('Login realizado com sucesso');
        $response->assertStatus(200);
    }

    protected function tearDown(): void
    {
        DB::rollBack();
        parent::tearDown();
    }
}
