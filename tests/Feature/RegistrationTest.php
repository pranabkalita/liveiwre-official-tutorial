<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_page_contains_livewire()
    {
        $this->get('/register')->assertSeeLivewire('auth.register');
    }

    public function test_can_register()
    {
        Livewire::test('auth.register')
            ->set('name', 'Test User')
            ->set('email', 'test@mail.com')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertRedirect('/');

        $this->assertTrue(User::whereEmail('test@mail.com')->exists());
        $this->assertEquals('test@mail.com', auth()->user()->email);
    }

    public function test_name_is_required()
    {
        Livewire::test('auth.register')
            ->set('name', '')
            ->set('email', 'pranab@mail.com')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertHasErrors(['name' => 'required']);
    }

    public function test_email_is_required()
    {
        Livewire::test('auth.register')
            ->set('name', 'Test User')
            ->set('email', '')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertHasErrors(['email' => 'required']);
    }

    public function test_email_is_valid_email()
    {
        Livewire::test('auth.register')
            ->set('name', 'Test User')
            ->set('email', 'pranab')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertHasErrors(['email' => 'email']);
    }

    public function test_see_email_hasnt_already_been_taken_validation_message_as_user_types()
    {
        User::create([
            'name' => 'Test User',
            'email' => 'pranab@mail.com',
            'password' => Hash::make('secret'),
        ]);

        Livewire::test('auth.register')
            ->set('email', 'prana@mail.com')
            ->assertHasNoErrors()
            ->set('email', 'pranab@mail.com')
            ->assertHasErrors(['email' => 'unique']);
    }

    public function test_email_is_has_not_been_taken_already()
    {
        User::create([
            'name' => 'Test User',
            'email' => 'pranab@mail.com',
            'password' => Hash::make('secret'),
        ]);

        Livewire::test('auth.register')
            ->set('name', 'Test User')
            ->set('email', 'pranab@mail.com')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertHasErrors(['email' => 'unique']);
    }

    public function test_password_is_required()
    {
        Livewire::test('auth.register')
            ->set('name', 'Test User')
            ->set('email', 'pranab@mail.com')
            ->set('password', '')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertHasErrors(['password' => 'required']);
    }

    public function test_password_is_min_of_six_characters()
    {
        Livewire::test('auth.register')
            ->set('name', 'Test User')
            ->set('email', 'pranab@mail.com')
            ->set('password', 'sec')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertHasErrors(['password' => 'min']);
    }

    public function test_password_matches_password_confirmation()
    {
        Livewire::test('auth.register')
            ->set('name', 'Test User')
            ->set('email', 'pranab@mail.com')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'not_secret')
            ->call('register')
            ->assertHasErrors(['password' => 'same']);
    }
}
