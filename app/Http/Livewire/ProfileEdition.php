<?php

namespace App\Http\Livewire;

use App\Enums\UserEmailPreference;
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
    public array $email_preferences = [];


    public User $user;

    protected function rules()
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore(Auth::user())],
            'bio' => ['nullable'],
            'rent_harness' => ['required', 'boolean'],
            'rent_shoes' => ['nullable', 'numeric', 'between:36,50'],
            'email_preferences' => ['required', 'array'],
        ];
    }

    public function render()
    {
        return view('livewire.profile-edition')
            ->layout('layouts.app');
    }

    public function mount(): void
    {
        $this->user = Auth::user();
        $this->email = $this->user->email;
        $this->bio = $this->user->bio;
        $this->rent_harness = $this->user->rent_harness;
        $this->rent_shoes = $this->user->rent_shoes;
        $this->email_preferences = $this->user->email_preferences;
    }

    public function isEmailPreferenceSelected(UserEmailPreference $preference): bool
    {
        return in_array($preference->value, $this->email_preferences, true);
    }

    public function toggleRentHarness(): void
    {
        $this->rent_harness = !$this->rent_harness;
    }

    public function toggleRentShoes(): void
    {
        if ($this->rent_shoes) {
            $this->rent_shoes = null;
        } else {
            $this->rent_shoes = 38;
        }
    }

    public function toggleEmailPreference(string $preference): void
    {
        $preferenceCase = UserEmailPreference::tryFrom($preference);

        if (!$preferenceCase) {
            throw new \Error('Invalid preference case');
        }

        if ($this->isEmailPreferenceSelected($preferenceCase)) {
            array_splice(
                $this->email_preferences,
                array_search($preferenceCase->value, $this->email_preferences, true),
                1
            );
        } else {
            $this->email_preferences[] = $preferenceCase->value;
        }
    }

    public function updatedAvatar(): void
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
            'email_preferences' => $validatedData['email_preferences'],
        ]);

        return redirect()->route('profile.show');
    }
}
