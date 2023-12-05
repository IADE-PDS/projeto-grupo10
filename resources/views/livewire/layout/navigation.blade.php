<?php

use Livewire\Volt\Component;

new class extends Component
{
    public function logout(): void
    {
        auth()->guard('web')->logout();

        session()->invalidate();
        session()->regenerateToken();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a wire:navigate href="{{ route('dashboard') }}" id="logo">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="block w-auto h-12 text-gray-800 fill-current" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-breeze.nav-link wire:navigate :href="route('dashboard')" :active="request()->routeIs('dashboard')" id="feedBtn">
                        @if (auth()->user()->isClient())
                            Meus Posts
                        @endif
                        @if (auth()->user()->isWorker())
                            Serviços disponíveis
                        @endif
                    </x-breeze.nav-link>
                    @if(auth()->user()->isWorker())
                    <x-breeze.nav-link wire:navigate :href="route('myservices')" :active="request()->routeIs('myservices')" id="feedBtn">
                        Meus Serviços
                    </x-breeze.nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center" id="profileDropdown">
                <livewire:balance />

                <x-breeze.dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button id="profileDropdownBtn" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                            <div id="nameText" x-data="{ name: '{{ auth()->user()->name }}' }" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div id="profileDropdownArrow" class="ml-1">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-breeze.dropdown-link wire:navigate :href="route('profile')" id="profileBtn">
                            Perfil
                        </x-breeze.dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="logout" id="logoutBtn" class="w-full text-left">
                            <x-breeze.dropdown-link>
                                Sair
                            </x-breeze.dropdown-link>
                        </button>
                    </x-slot>
                </x-breeze.dropdown>

                {{-- Notification Dropdown --}}
                <livewire:notification />
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -mr-2 sm:hidden">
                <button id="hamburgerBtn" @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" id="respNavMenu" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-breeze.responsive-nav-link wire:navigate :href="route('dashboard')" :active="request()->routeIs('dashboard')" id="respFeedBtn">
                Dashboard
            </x-breeze.responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div id="respNameText" font-medium text-base text-gray-800" x-data="{ name: '{{ auth()->user()->name }}' }" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div id="respEmailText" class="text-sm font-medium text-gray-500">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-breeze.responsive-nav-link wire:navigate :href="route('profile')" id="respProfileBtn">
                    Perfil
                </x-breeze.responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-left" id="respLogoutBtn">
                    <x-breeze.responsive-nav-link>
                        Sair
                    </x-breeze.responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
