<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Profile extends Component
{
    public $username = '';
    public $about = '';

    public function mount()
    {
        $this->username = auth()->user()->username;
        $this->about = auth()->user()->about;
    }

    public function save()
    {
        $validatedData = $this->validate([
            'username' => ['max:24'],
            'about' => ['max:124']
        ]);
        auth()->user()->update($validatedData);
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
