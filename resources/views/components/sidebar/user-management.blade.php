<div x-data="{ openUser: {{ request()->routeIs('users.*') || request()->routeIs('departments.*') || request()->routeIs('positions.*') ? 'true' : 'false' }} }" class="space-y-1">
    <button @click="openUser = !openUser"
        class="w-full group flex items-center px-4 py-3 text-sm font-medium rounded-lg 
    text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white transition-colors duration-200">

        <!-- 🔹 User Group Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87
               M9 20H4v-2a4 4 0 013-3.87
               m10-6.13a4 4 0 11-8 0 4 4 0 018 0zm6 4a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>

        User Management

        <svg class="ml-auto h-4 w-4 transform transition" :class="openUser ? 'rotate-180' : ''" viewBox="0 0 20 20"
            fill="currentColor">
            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11l3.71-3.77a.75.75 0
               011.08 1.04l-4.25 4.32a.75.75 0 01-1.08 0L5.21
               8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
        </svg>
    </button>


    <div x-show="openUser" class="pl-10 space-y-1">


        <a href="{{ route('departments.index') }}"
            class="block px-3 py-2 rounded {{ request()->routeIs('departments.*') ? 'bg-white bg-opacity-20 text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
            Departments
        </a>

        <a href="{{ route('positions.index') }}"
            class="block px-3 py-2 rounded {{ request()->routeIs('positions.*') ? 'bg-white bg-opacity-20 text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
            Job Titles
        </a>
        @permission('users.view')
            <a href="{{ route('users.index') }}"
                class="block px-3 py-2 rounded {{ request()->routeIs('users.*') ? 'bg-white bg-opacity-20 text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
                Users
            </a>
        @endpermission


    </div>
</div>
