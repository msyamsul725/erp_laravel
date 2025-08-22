  <div x-data="{ openInventory: {{ request()->routeIs('inventory.*') || request()->routeIs('receiving.*') ? 'true' : 'false' }} }" class="space-y-1">

      <!-- Main Menu Button -->
      <button @click="openInventory = !openInventory"
          class="w-full group flex items-center px-4 py-3 text-sm font-medium rounded-lg 
               text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white transition-colors duration-200">

          <!-- Inventory Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round"
                  d="M20.25 7.5l-8.25-4.5-8.25 4.5m16.5 0l-8.25 4.5m8.25-4.5v9l-8.25 4.5m0-9l-8.25-4.5m8.25 4.5v9m-8.25-13.5v9l8.25 4.5" />
          </svg>

          Inventory

          <svg class="ml-auto h-4 w-4 transform transition" :class="openInventory ? 'rotate-180' : ''"
              viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                  d="M5.23 7.21a.75.75 0 011.06.02L10 11l3.71-3.77a.75.75 0 011.08 1.04l-4.25 4.32a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z"
                  clip-rule="evenodd" />
          </svg>
      </button>

      <!-- Submenus -->
      <div x-show="openInventory" class="pl-10 space-y-1">

          <!-- Receiving -->
          <div x-data="{ openReceiving: {{ request()->routeIs('receiving.*') ? 'true' : 'false' }} }">
              <button @click="openReceiving = !openReceiving"
                  class="w-full flex items-center px-3 py-2 text-left rounded 
                       {{ request()->routeIs('receiving.*') ? 'bg-white bg-opacity-20 text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
                  Receiving
                  <svg class="ml-auto h-4 w-4 transform transition" :class="openReceiving ? 'rotate-180' : ''"
                      viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd"
                          d="M5.23 7.21a.75.75 0 011.06.02L10 11l3.71-3.77a.75.75 0 011.08 1.04l-4.25 4.32a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z"
                          clip-rule="evenodd" />
                  </svg>
              </button>

              <!-- Receiving Submenus -->
              <div x-show="openReceiving" class="pl-6 mt-1 space-y-1">
                  <a href="{{ route('receiving.input-head-location') }}"
                      class="block px-3 py-2 rounded {{ request()->routeIs('receiving.input-head-location') ? 'bg-white bg-opacity-20 text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
                      Head Loc
                  </a>
                  <a href="{{ route('receiving.input-location') }}"
                      class="block px-3 py-2 rounded {{ request()->routeIs('receiving.input-location') ? 'bg-white bg-opacity-20 text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
                      Location
                  </a>
                  <a href="{{ route('receiving.list-part-area') }}"
                      class="block px-3 py-2 rounded {{ request()->routeIs('receiving.list-part-area') ? 'bg-white bg-opacity-20 text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
                      Part Area
                  </a>
                  <a href="{{ route('receiving.manage-part-data') }}"
                      class="block px-3 py-2 rounded {{ request()->routeIs('receiving.manage-part-data') ? 'bg-white bg-opacity-20 text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
                      Part Data
                  </a>
                  <a href="{{ route('receiving.report') }}"
                      class="block px-3 py-2 rounded {{ request()->routeIs('receiving.report') ? 'bg-white bg-opacity-20 text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
                      Report
                  </a>
              </div>
          </div>

          <!-- Warehouse -->
          <a href="{{ route('inventory.warehouse') }}"
              class="block px-3 py-2 rounded {{ request()->routeIs('inventory.warehouse') ? 'bg-white bg-opacity-20 text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
              Warehouse
          </a>

          <!-- Finished Goods -->
          <a href="{{ route('inventory.finished-goods') }}"
              class="block px-3 py-2 rounded {{ request()->routeIs('inventory.finished-goods') ? 'bg-white bg-opacity-20 text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
              Finished Goods
          </a>

          <!-- Delivery -->
          <a href="{{ route('inventory.delivery') }}"
              class="block px-3 py-2 rounded {{ request()->routeIs('inventory.delivery') ? 'bg-white bg-opacity-20 text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
              Delivery
          </a>

      </div>
  </div>
