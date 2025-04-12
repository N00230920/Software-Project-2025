<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    // @return array[]

    public static function userDataProvider():array
    {
        $user = [];

        for ($i = 1;$i <= 100;$i++){
            $user[]=[
                'Test User' . $i,
                'testuser' . $i . '@example.com',
                'password',
                $i % 2 === 0 ? 'admin':'user'
            ];
        }

        return $user;
    }

    /**
     * @dataProvider userDataProvider
     */
    public function test_new_users_can_register($name, $email, $password, $role): void
    {
        $response = $this->post('/register', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
            'role' => $role,
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }
}
