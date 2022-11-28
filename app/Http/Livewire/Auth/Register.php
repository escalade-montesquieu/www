<?php

namespace App\Http\Livewire\Auth;

use App\Models\Student;
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
        $this->validateOnly($propertyName);
    }

    public function isNameValid(): bool
    {
        return Student::where('name', $this->name)->count();
    }

    public function nextStep(): void
    {
        if ($this->isNameValid()) {
            $this->step = 2;
        }
    }

    public function isNameLongEnoughToShowSuggestions(): bool
    {
        return strlen($this->name) > 3;
    }

    public function updatedName(): void
    {
        if ($this->isNameLongEnoughToShowSuggestions()) {
            $this->fetchNameSuggestionsArray();
        }
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

    public function register(): void
    {
        $validatedData = $this->validate();

    }
}
