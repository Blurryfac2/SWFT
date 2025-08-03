<nav x-data="{ open: false }" class="bg-[#0c0c0c] border-b border-[#d4af37] shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <div class="flex items-center space-x-3">
                <div class="flex items-center space-x-3 md:hidden">
                    <a href="{{ route('admin.products.index') }}" class="shrink-0">
                        <img src="{{ asset('img/logo.jpg') }}" alt="Logo" class="h-10 w-10 rounded-full object-cover border-2 border-[#d4af37]" />
                    </a>
                    <div class="flex flex-col text-white">
                        <span class="text-sm font-semibold">{{ Auth::user()->name }}</span>
                        <span class="text-xs text-gray-400">{{ Auth::user()->email }}</span>
                    </div>
                </div>

                <a href="{{ route('admin.products.index') }}" class="shrink-0 hidden md:block">
                    <img src="{{ asset('img/logo.jpg') }}" alt="Logo" class="h-10 w-10 rounded-full object-cover border-2 border-[#d4af37]" />
                </a>

                <div class="hidden md:flex space-x-6 ms-6">
                    <x-nav-link :href="route('admin.products.index')" class="text-white hover:text-[#d4af37]">
                        {{ __('Productos') }}
                    </x-nav-link>
                    <x-nav-link :href="route('carousel.index')" class="text-white hover:text-[#d4af37]">
                        {{ __('Carrusel') }}
                    </x-nav-link>
                    <x-nav-link :href="route('contactos.index')" class="text-white hover:text-[#d4af37]">
                        {{ __('Correos') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden md:flex items-center space-x-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-[#d4af37] text-sm font-medium rounded-md text-white bg-[#1a1a1a] hover:text-[#d4af37] transition">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="ml-1 h-4 w-4 text-[#d4af37]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill="currentColor" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Cerrar sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="md:hidden flex items-center">
                <button @click="open = ! open" class="p-2 rounded-md text-[#d4af37] hover:text-white hover:bg-[#1a1a1a] transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" x-transition class="md:hidden bg-[#0c0c0c] border-t border-[#d4af37]">
        <div class="pt-2 pb-3 px-4 overflow-x-auto">
            <div class="flex space-x-4 whitespace-nowrap justify-center text-white">
                <x-nav-link @click="open = false" :href="route('admin.products.index')" class="hover:text-[#d4af37]">
                    {{ __('Productos') }}
                </x-nav-link>
                <x-nav-link @click="open = false" :href="route('carousel.index')" class="hover:text-[#d4af37]">
                    {{ __('Carrusel') }}
                </x-nav-link>
                <x-nav-link @click="open = false" :href="route('contactos.index')" class="hover:text-[#d4af37]">
                    {{ __('Correos') }}
                </x-nav-link>
                <x-nav-link @click="open = false" :href="route('profile.edit')" class="hover:text-[#d4af37]">
                    {{ __('Perfil') }}
                </x-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-nav-link :href="route('logout')" class="hover:text-red-500"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Cerrar') }}
                    </x-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
