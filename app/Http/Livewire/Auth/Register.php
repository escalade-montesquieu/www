<?php

namespace App\Http\Livewire\Auth;

use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public string $name = '';
    public array $nameSuggestions = [];
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public int $step = 1;

    protected array $rules = [
        'name' => ['required', 'string', 'max:255', 'exists:students,name', 'unique:users,name'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        'password' => ['required', 'string'],
        'password_confirmation' => ['required', 'string', 'same:password'],
    ];

    protected array $messages = [
        'name.exists' => 'Essayez avec votre nom complet. Vous n\'êtes peut-être pas sur la liste des licenciés. Merci de contacter M.Granier au lycée si vous êtes licenciés.'
    ];

    public function render()
    {
        return view('livewire.auth.register')
            ->layout('layouts.auth');
    }

    public function updated($propertyName): void
    {
        if ($propertyName === 'name') {
            if ($this->isNameLongEnoughToShowSuggestions()) {
                $this->fetchNameSuggestionsArray();
            }
            return;
        }
        $this->validateOnly($propertyName);
    }

    public function canNextStep(): bool
    {
        if ($student = Student::where('name', $this->name)->first()) {
            return !$student->user;
        }

        return false;
    }

    public function nextStep(): void
    {
        if ($this->canNextStep()) {
            $this->step = 2;
        }
    }

    public function isNameLongEnoughToShowSuggestions(): bool
    {
        return strlen($this->name) > 3;
    }

    public function fetchNameSuggestionsArray(): void
    {
        $this->nameSuggestions = Student::where('name', 'LIKE', $this->name . '%')
            ->select('name')
            ->get()
            ->pluck('name')
            ->toArray();
    }

    public function setName(string $newName): void
    {
        $this->name = $newName;
    }

    public function register()
    {
        $validatedData = $this->validate();

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'student_id' => Student::where('name', $validatedData['name'])->first()->id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('home');
    }
}
