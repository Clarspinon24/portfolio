<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'   => ['required', 'string', 'min:8', 'confirmed'],
            'phone'      => ['nullable', 'string', 'max:20'],
            'birth_date' => ['nullable', 'date', 'before:today'],
            'terms'      => ['accepted'],
        ], [
            'first_name.required' => 'Le prénom est obligatoire.',
            'last_name.required'  => 'Le nom est obligatoire.',
            'email.required'      => "L'adresse e-mail est obligatoire.",
            'email.email'         => "L'adresse e-mail n'est pas valide.",
            'email.unique'        => 'Cette adresse e-mail est déjà utilisée.',
            'password.required'   => 'Le mot de passe est obligatoire.',
            'password.min'        => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed'  => 'Les mots de passe ne correspondent pas.',
            'birth_date.before'   => 'La date de naissance doit être dans le passé.',
            'terms.accepted'      => 'Vous devez accepter les conditions d\'utilisation.',
        ]);

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'email'      => $validated['email'],
            'password'   => Hash::make($validated['password']),
            'phone'      => $validated['phone'] ?? null,
            'birth_date' => $validated['birth_date'] ?? null,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')
            ->with('success', 'Bienvenue ! Votre compte a été créé avec succès.');
    }
}