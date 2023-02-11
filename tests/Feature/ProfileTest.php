<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_see_livewire_profile_component_on_profile_page()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/profile')
            ->assertSuccessful()
            ->assertSeeLivewire('profile');
    }

    public function test_profile_info_is_pre_populated()
    {
        $user = User::create([
            'username' => 'foo',
            'about' => 'bar',
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => 'secret'
        ]);

        Livewire::actingAs($user)
            ->test('profile')
            ->assertSet('username', 'foo')
            ->assertSet('about', 'bar');
    }

    public function test_saved_message_is_shown_on_save()
    {
        $user = User::create([
            'username' => 'foo',
            'about' => 'bar',
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => 'secret'
        ]);

        Livewire::actingAs($user)
            ->test('profile')
            ->assertDontSee('Profile Saved!')
            ->call('save')
            ->assertSee('Profile Saved!');
    }

    public function test_can_update_profile()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test('profile')
            ->set('username', 'foo')
            ->set('about', 'bar')
            ->call('save');

        $user->refresh();

        $this->assertEquals('foo', $user->username);
        $this->assertEquals('bar', $user->about);
    }

    public function test_username_must_be_less_than_24_characters()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test('profile')
            ->set('username', str_repeat('a', 25))
            ->set('about', 'bar')
            ->call('save')
            ->assertHasErrors(['username' => 'max']);
    }

    public function test_about_must_be_less_than_124_characters()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test('profile')
            ->set('username', 'foo')
            ->set('about', str_repeat('a', 125))
            ->call('save')
            ->assertHasErrors(['about' => 'max']);
    }
}
