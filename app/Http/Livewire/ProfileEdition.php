<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileEdition extends Component
{
    use WithFileUploads;

    public $avatar = null;
    public string $email = "";
    public ?string $bio = null;
    public bool $rent_harness = false;
    public ?int $rent_shoes = null;

    public User $user;

    protected function rules()
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore(Auth::user())],
            'bio' => ['nullable'],
            'rent_harness' => ['required', 'boolean'],
            'rent_shoes' => ['nullable', 'numeric', 'between:36,50'],
        ];
    }

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

    public function updatedAvatar()
    {
        $this->validate([
            'avatar' => ['nullable', 'image', 'max:10240'],
        ]);

        $path = 'avatars/';
        $filename = Str::uuid() . "." . $this->avatar->getClientOriginalExtension();
        $this->avatar->storeAs('public/' . $path, $filename);

        $this->user->update([
            'avatar_url' => 'storage/' . $path . $filename
        ]);
    }

    public function saveChanges()
    {
        $validatedData = $this->validate();

        $this->user->update([
            'bio' => $validatedData['bio'],
            'email' => $validatedData['email'],
            'rent_harness' => $validatedData['rent_harness'],
            'rent_shoes' => $validatedData['rent_shoes'],
        ]);

        return redirect()->route('profile.show');
    }
}
