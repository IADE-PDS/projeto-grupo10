<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.custom')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $role = 'client';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        auth()->login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }

    public function changeRole(): void
    {
        $this->role = $this->role === 'client' ? 'worker' : 'client';
    }
}; ?>

<div>
    <section class="bg-white">
        <div class="flex justify-center min-h-screen">
            <div class="hidden bg-cover lg:block lg:w-2/5" style="background-image: url('https://images.unsplash.com/photo-1633014041037-f5446fb4ce99?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80')">
            </div>

            <div class="flex items-center w-full max-w-3xl p-8 mx-auto lg:px-12 lg:w-3/5">
                <div class="w-full">
                    <h1 class="text-2xl font-semibold tracking-wider text-gray-800 capitalize">
                        Cadastre sua conta agora de forma gratuita.
                    </h1>

                    <p class="mt-4 text-gray-500">
                        Vamos preparar tudo para que você possa verificar sua conta pessoal e começar a configurar seu perfil.
                    </p>
                    {{-- Role --}}
                    <div class="mt-6">
                        <h1 class="text-gray-500">Selecione o tipo de conta</h1>

                        <div class="mt-3 md:flex md:items-center md:-mx-2">
                            <button wire:click='changeRole'
                            x-on:click="selectedRole = 'cliente';"
                            :class="{ 'bg-blue-500 text-white': selectedRole === 'cliente' }"
                            class="flex justify-center w-full px-6 py-3 text-blue-500 border border-blue-500 rounded-lg md:w-auto md:mx-2 focus:outline-none"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>


                                <span class="mx-2">
                                    Cliente
                                </span>
                            </button>

                            <button wire:click='changeRole'
                            x-on:click="selectedRole = 'lavador';"
                            :class="{ 'bg-blue-500 text-white': selectedRole === 'lavador' }"
                            class="flex justify-center w-full px-6 py-3 mt-4 text-blue-500 border border-blue-500 rounded-lg md:mt-0 md:w-auto md:mx-2 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>

                                <span class="mx-2">
                                    Lavador
                                </span>
                            </button>
                        </div>
                    </div>

                    <form wire:submit="register">
                        <!-- Name -->
                        <div>
                            <x-breeze.input-label for="name" :value="__('Name')" />
                            <x-breeze.text-input wire:model="name" id="name" class="block w-full mt-1" type="text" name="name" required autofocus autocomplete="name" />
                            <x-breeze.input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-breeze.input-label for="email" :value="__('Email')" />
                            <x-breeze.text-input wire:model="email" id="email" class="block w-full mt-1" type="email" name="email" required autocomplete="username" />
                            <x-breeze.input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                       <div class="flex justify-between">
                            <!-- Password -->
                            <div class="flex-1 mt-4 mr-5">
                                <x-breeze.input-label for="password" :value="__('Password')" />

                                <x-breeze.text-input wire:model="password" id="password" class="block w-full mt-1"
                                                type="password"
                                                name="password"
                                                required autocomplete="new-password" />

                                <x-breeze.input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-4">
                                <x-breeze.input-label for="password_confirmation" :value="__('Confirm Password')" />

                                <x-breeze.text-input wire:model="password_confirmation" id="password_confirmation" class="block w-full mt-1"
                                                type="password"
                                                name="password_confirmation" required autocomplete="new-password" />

                                <x-breeze.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                       </div>

                        <div class="flex items-center justify-end mt-4">
                            <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>
                                {{ __('Already registered?') }}
                            </a>

                            <x-breeze.primary-button class="ml-4">
                                <div class="ml-3" wire:loading>
                                    <span class="loading loading-spinner text-warning"></span>
                                </div>
                                {{ __('Register') }}
                            </x-breeze.primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            window.selectedRole = 'cliente';
        </script>
    </section>
</div>
