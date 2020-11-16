<?php

namespace Tests\Feature;

use App\Models\User\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SettingsTest extends TestCase
{
    /** @test */
    public function update_profile_info()
    {
        $this->actingAs($user = User::factory()->create())
            ->patchJson(
                '/api/profile/update-info',
                [
                    'first_name' => 'first',
                    'last_name' => 'last',
                    'email' => 'test@test.app',
                ]
            )
            ->assertSuccessful()
            ->assertJsonStructure(
                [
                    'id',
                    'first_name',
                    'last_name',
                    'email',
                ]
            );

        $this->assertDatabaseHas(
            'users',
            [
                'id' => $user->id,
                'first_name' => 'first',
                'last_name' => 'last',
                'email' => 'test@test.app',
            ]
        );
    }

    /** @test */
    public function update_password()
    {
        $this->actingAs($user = User::factory()->create())
            ->patchJson(
                '/api/profile/update-password',
                [
                    'password' => 'updated',
                    'password_confirmation' => 'updated',
                ]
            )
            ->assertSuccessful();

        $this->assertTrue(Hash::check('updated', $user->password));
    }
}
