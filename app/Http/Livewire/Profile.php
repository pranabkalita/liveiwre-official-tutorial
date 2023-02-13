<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $username = '';
    public $about = '';
    public $birthday = null;
    public $newAvatar = '';
    public $saved = false;

    // Hooks
    public function mount()
    {
        $this->username = auth()->user()->username;
        $this->about = auth()->user()->about;
        $this->birthday = optional(auth()->user()->birthday)->format('m/d/Y');
    }

    public function updated($field)
    {
        if ($field != 'saved') {
            $this->saved = false;
        }
    }

    public function updatedNewAvatar()
    {
        $this->validate([
            'newAvatar' => ['image', 'max:1000']
        ]);
    }

    // Methods
    public function setAsUnsaved()
    {
        $this->saved = false;
    }

    public function save()
    {
        $this->validate([
            'username' => ['max:24'],
            'about' => ['max:124'],
            'birthday' => ['sometimes'],
            'newAvatar' => ['image', 'max:1000']
        ]);

        $filename = $this->newAvatar->store('/', 'avatars');

        auth()->user()->update([
            'username' => $this->username,
            'about' => $this->about,
            'birthday' => $this->birthday,
            'avatar' => $filename,
        ]);

        $this->saved = true;
        $this->dispatchBrowserEvent('notify', 'Profile Saved!');
        $this->emitSelf('notify-saved');
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
