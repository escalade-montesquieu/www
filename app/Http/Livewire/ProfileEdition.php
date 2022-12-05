<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProfileEdition extends Component
{
    public string $email = "";
    public ?string $bio = null;
    public bool $rent_harness = false;
    public ?int $rent_shoes = null;

    public User $user;

    public function render()
    {
        return view('livewire.profile-edition')
            ->layout('layouts.app');
    }

    public function mount()
    {
        $this->user = Auth::user();
        $this->email = $this->user->email;
        $this->bio = $this->user->bio;
        $this->rent_harness = $this->user->rent_harness;
        $this->rent_shoes = $this->user->rent_shoes;
    }

    public function toggleRentHarness()
    {
        $this->rent_harness = !$this->rent_harness;
    }

    public function toggleRentShoes()
    {
        if ($this->rent_shoes) {
            $this->rent_shoes = null;
        } else {
            $this->rent_shoes = 38;
        }
    }

    public function saveChanges()
    {
        $this->user->update([
            'bio' => $this->bio,
            'email' => $this->email,
            'rent_harness' => $this->rent_harness,
            'rent_shoes' => $this->rent_shoes,
        ]);

        return redirect()->route('profile.show');
    }
}
