<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Profile extends Component
{
    public $username = '';
    public $about = '';
    public $birthday = null;
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

    // Methods
    public function setAsUnsaved()
    {
        $this->saved = false;
    }

    public function save()
    {
        $validatedData = $this->validate([
            'username' => ['max:24'],
            'about' => ['max:124'],
            'birthday' => ['sometimes']
        ]);
        auth()->user()->update($validatedData);

        $this->saved = true;
        $this->dispatchBrowserEvent('notify', 'Profile Saved!');
        $this->emitSelf('notify-saved');
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
