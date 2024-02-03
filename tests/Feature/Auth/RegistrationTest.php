<?php

namespace Tests\Feature\Auth;

use App\Models\Student;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register_if_they_are_on_students_list()
    {
        $this->markTestIncomplete();
        Student::factory()->create([
            'name' => 'Test User'
        ]);

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertDatabaseHas(User::class, [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_new_users_cannot_register_if_they_are_not_on_students_list()
    {
        $this->markTestIncomplete();

        $response = $this->post('/register', [
            'name' => 'Test User Not Registered',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertGuest();
    }
}
