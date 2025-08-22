<div class="pt-4 mt-4 border-t border-blue-400 border-opacity-30">
    <p class="px-4 text-xs font-semibold text-blue-200 uppercase tracking-wider">Account</p>
    <div class="mt-2 space-y-2">
        <a href="{{ route('profile.index') }}"
            class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg 
            {{ request()->routeIs('profile.*') ? 'bg-white bg-opacity-20 text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Profile Settings
        </a>
        <div x-data="{ open: {{ request()->routeIs('learning.*') ? 'true' : 'false' }} }" class="space-y-1">
            <button @click="open = !open"
                class="w-full group flex items-center px-4 py-3 text-sm font-medium rounded-lg text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white transition-colors duration-200">
                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v1m0 6v1m8-6h-1M5 5H4m16 14h-1M5 19H4M4 12h1m14 0h1" />
                </svg>
                Learning with Laravel
                <svg class="ml-auto h-4 w-4 transform transition" :class="open ? 'rotate-180' : ''" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 11l3.71-3.77a.75.75 0 011.08 1.04l-4.25 4.32a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="open" class="pl-10 space-y-1">
                <a href="{{ route('learning.php-dasar') }}"
                    class="block px-3 py-2 rounded {{ request()->routeIs('learning.php-dasar') ? 'bg-white bg-opacity-20 text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
                    PHP 8+ Dasar
                </a>
                <a href="{{ route('learning.js-dasar') }}"
                    class="block px-3 py-2 rounded {{ request()->routeIs('learning.js-dasar') ? 'bg-white bg-opacity-20 text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
                    JS Komponen
                </a>
            </div>
        </div>
    </div>
</div>
