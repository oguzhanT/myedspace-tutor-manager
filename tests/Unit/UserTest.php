<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_name_attribute()
    {
        $user = User::factory()->create(['name' => 'John Doe']);

        $this->assertEquals('John Doe', $user->name);
    }

    public function test_user_has_email_attribute()
    {
        $user = User::factory()->create(['email' => 'john@example.com']);

        $this->assertEquals('john@example.com', $user->email);
    }

    public function test_user_has_password_attribute()
    {
        $user = User::factory()->create(['password' => bcrypt('password')]);

        $this->assertTrue(password_verify('password', $user->password));
    }

    public function test_user_has_timestamps()
    {
        $user = User::factory()->create();

        $this->assertNotNull($user->created_at);
        $this->assertNotNull($user->updated_at);
    }
}
