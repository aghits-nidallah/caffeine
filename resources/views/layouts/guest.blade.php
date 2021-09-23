<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            @if ($show_header)
                <div class="bg-white py-3 shadow">
                    <div class="flex justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center">
                            <x-application-logo class="w-8 h-8 mr-4" />
                            <form action="{{ route('index') }}" method="get">
                                @csrf
                                <x-input type="text" name="search" id="search" placeholder="Cari..." />
                            </form>
                        </div>
                        <div class="flex items-center">
                            <x-dropdown align="right" class="!cursor-pointer">
                                <x-slot name="trigger">
                                    @guest
                                        <i class="fas fa-user"></i>
                                    @else
                                        <i class="fas fa-user mr-2"></i>
                                        {{ auth()->user()->name }}
                                    @endguest
                                </x-slot>

                                <x-slot name="content">
                                    @guest
                                        <x-dropdown-link :href="route('login')">
                                            Masuk
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('register')">
                                            Daftar
                                        </x-dropdown-link>
                                    @else
                                        <x-dropdown-link :href="route('dashboard.index')">
                                            Dashboard
                                        </x-dropdown-link>
                                        
                                        <div class="border-b border-gray-300 my-1"></div>

                                        <x-dropdown-link>
                                            Keranjang
                                        </x-dropdown-link>
                                        
                                        <div class="border-b border-gray-300 my-1"></div>
                                        
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                
                                            <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    @endguest
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </div>
            @endif
        
            {{ $slot }}

            @if ($show_footer)
                <div class="bg-white border-t border-gray-300 py-3">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        Copyright &copy; <a href="https://github.com/aghits-nidallah" target="_blank">Aghits Nidallah</a> & <a href="https://github.com/NikarashiHatsu" target="_blank">Hatsu Shiroyuki</a> @2021
                    </div>
                </div>
            @endif
        </div>
    </body>
</html>
