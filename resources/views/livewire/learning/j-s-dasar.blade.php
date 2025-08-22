<div class="container mx-auto p-6 space-y-12" x-data="{
    // State global
    darkMode: false,
    modal: false,
    dropdown: false,
    tab: '1',
    accordion: null,
    tooltip: false,
    counter: 0,
    form: { name: '', email: '', password: '' },
    sidebar: false,
    toast: false,
    passwordVisible: false,
    progress: 40,
    rating: 0,
    search: '',
    items: ['Apple', 'Banana', 'Cherry', 'Date', 'Fig'],
    loading: false,
    step: 1,
    openCollapse: false,
    fileName: '',
    tags: [],
    newTag: '',
    toggleSwitch: false,
    rangeValue: 50,
    multiSelect: [],
    dateValue: '',
    timeValue: '',
    charCount: '',
    selectedImage: '',
    jsonData: { name: 'John', age: 30 },
    isSticky: false,
    notificationCount: 3,
    currency: '',
    textarea: '',
    checkAll: false,
    selectedCheckboxes: [],
    popover: false,
    badgeText: 'New',
    currentPage: 1,
    totalPages: 5
}"
    :class="darkMode ? 'bg-gray-900 text-white' : 'bg-white text-black'">

    <h1 class="text-3xl font-bold">🔥 50 Komponen Alpine.js Sering Digunakan</h1>
    <p class="text-gray-500 dark:text-gray-400">Semua contoh ini ada dalam 1 halaman untuk belajar dan referensi.</p>

    {{-- 1. Dark Mode --}}
    <section>
        <h2 class="font-semibold mb-2">1. Dark Mode Toggle</h2>
        <button @click="darkMode = !darkMode" class="px-4 py-2 bg-indigo-600 text-white rounded">Toggle Dark Mode</button>
    </section>

    {{-- 2. Modal --}}
    <section>
        <h2 class="font-semibold mb-2">2. Modal</h2>
        <button @click="modal = true" class="px-4 py-2 bg-blue-600 text-white rounded">Open Modal</button>
        <div x-show="modal" x-transition class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white dark:bg-gray-800 p-6 rounded" @click.away="modal = false">
                <h3 class="text-lg font-bold">Hello from Modal</h3>
                <button @click="modal = false" class="mt-4 px-3 py-1 bg-gray-200 rounded">Close</button>
            </div>
        </div>
    </section>

    {{-- 3. Dropdown --}}
    <section>
        <h2 class="font-semibold mb-2">3. Dropdown</h2>
        <div class="relative">
            <button @click="dropdown = !dropdown" class="px-4 py-2 bg-green-600 text-white rounded">Menu ▼</button>
            <div x-show="dropdown" @click.away="dropdown = false" x-transition
                class="absolute mt-2 bg-white dark:bg-gray-700 shadow rounded">
                <a href="#" class="block px-4 py-2 hover:bg-gray-100">Item 1</a>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100">Item 2</a>
            </div>
        </div>
    </section>

    {{-- 4. Tabs --}}
    <section>
        <h2 class="font-semibold mb-2">4. Tabs</h2>
        <div class="flex space-x-2 mb-4">
            <button @click="tab = '1'" :class="tab === '1' ? 'bg-blue-600 text-white' : 'bg-gray-200'"
                class="px-3 py-1 rounded">Tab 1</button>
            <button @click="tab = '2'" :class="tab === '2' ? 'bg-blue-600 text-white' : 'bg-gray-200'"
                class="px-3 py-1 rounded">Tab 2</button>
        </div>
        <div x-show="tab === '1'" class="p-4 bg-gray-100 rounded">Content Tab 1</div>
        <div x-show="tab === '2'" class="p-4 bg-gray-100 rounded">Content Tab 2</div>
    </section>

    {{-- 5. Accordion --}}
    <section>
        <h2 class="font-semibold mb-2">5. Accordion</h2>
        <template x-for="i in 3" :key="i">
            <div class="border rounded mb-2">
                <button @click="accordion === i ? accordion = null : accordion = i"
                    class="w-full text-left px-4 py-2 bg-gray-200">Section <span x-text="i"></span></button>
                <div x-show="accordion === i" x-transition class="p-4 bg-gray-50">Content <span x-text="i"></span>
                </div>
            </div>
        </template>
    </section>

    {{-- 6. Tooltip --}}
    <section>
        <h2 class="font-semibold mb-2">6. Tooltip</h2>
        <div class="relative inline-block">
            <button @mouseenter="tooltip = true" @mouseleave="tooltip = false"
                class="px-4 py-2 bg-yellow-500 text-white rounded">Hover Me</button>
            <div x-show="tooltip" x-transition
                class="absolute bottom-full mb-2 px-2 py-1 bg-black text-white text-xs rounded">Tooltip Text</div>
        </div>
    </section>

    {{-- 7. Counter --}}
    <section>
        <h2 class="font-semibold mb-2">7. Counter</h2>
        <div class="flex items-center space-x-3">
            <button @click="counter--" class="px-3 py-1 bg-red-500 text-white rounded">-</button>
            <span x-text="counter" class="text-lg"></span>
            <button @click="counter++" class="px-3 py-1 bg-green-500 text-white rounded">+</button>
        </div>
    </section>

    {{-- 8. Form Binding --}}
    <section>
        <h2 class="font-semibold mb-2">8. Form Binding</h2>
        <input x-model="form.name" placeholder="Name" class="border rounded px-3 py-1">
        <p class="mt-2">Hello, <span x-text="form.name"></span></p>
    </section>

    {{-- 9. Sidebar --}}
    <section>
        <h2 class="font-semibold mb-2">9. Sidebar</h2>
        <button @click="sidebar = true" class="px-3 py-1 bg-purple-600 text-white rounded">Open Sidebar</button>
        <div x-show="sidebar" class="fixed inset-0 flex">
            <div class="bg-white dark:bg-gray-800 w-64 p-4" @click.away="sidebar = false">
                <h3 class="font-bold">Sidebar</h3>
            </div>
        </div>
    </section>

    {{-- 10. Toast --}}
    <section>
        <h2 class="font-semibold mb-2">10. Toast</h2>
        <button @click="toast = true; setTimeout(()=>toast=false, 3000)"
            class="px-3 py-1 bg-pink-600 text-white rounded">Show Toast</button>
        <div x-show="toast" x-transition class="fixed bottom-4 right-4 bg-green-600 text-white px-4 py-2 rounded">This
            is a toast!</div>
    </section>

    {{-- 11. Password Toggle --}}
    <section>
        <h2 class="font-semibold mb-2">11. Password Toggle</h2>
        <div class="flex">
            <input :type="passwordVisible ? 'text' : 'password'" class="border px-3 py-1 rounded-l">
            <button @click="passwordVisible = !passwordVisible" class="px-3 py-1 bg-gray-200 rounded-r">👁</button>
        </div>
    </section>

    {{-- 12. Progress Bar --}}
    <section>
        <h2 class="font-semibold mb-2">12. Progress Bar</h2>
        <div class="w-full bg-gray-200 rounded h-4">
            <div class="bg-blue-600 h-4 rounded" :style="'width:' + progress + '%'"></div>
        </div>
        <button @click="progress += 10" class="mt-2 px-3 py-1 bg-blue-500 text-white rounded">Increase</button>
    </section>

    {{-- 13. Rating --}}
    <section>
        <h2 class="font-semibold mb-2">13. Rating</h2>
        <template x-for="i in 5" :key="i">
            <span @click="rating = i" class="cursor-pointer"
                :class="i <= rating ? 'text-yellow-500' : 'text-gray-400'">★</span>
        </template>
    </section>

    {{-- 14. Search Filter --}}
    <section>
        <h2 class="font-semibold mb-2">14. Search Filter</h2>
        <input x-model="search" placeholder="Search..." class="border px-3 py-1 rounded mb-2">
        <ul>
            <template x-for="item in items.filter(i => i.toLowerCase().includes(search.toLowerCase()))"
                :key="item">
                <li x-text="item"></li>
            </template>
        </ul>
    </section>

    {{-- 15. Loading Spinner --}}
    <section>
        <h2 class="font-semibold mb-2">15. Loading Spinner</h2>
        <button @click="loading = true; setTimeout(()=>loading=false, 2000)"
            class="px-3 py-1 bg-indigo-500 text-white rounded">Load</button>
        <div x-show="loading"
            class="mt-2 border-4 border-blue-500 border-t-transparent rounded-full w-6 h-6 animate-spin"></div>
    </section>
    {{-- 16. Alert Box --}}
    <section>
        <h2 class="font-semibold mb-2">16. Alert Box</h2>
        <div class="p-4 bg-red-100 text-red-700 rounded">This is an alert message!</div>
    </section>

    {{-- 17. Collapse --}}
    <section>
        <h2 class="font-semibold mb-2">17. Collapse</h2>
        <button @click="openCollapse = !openCollapse" class="px-3 py-1 bg-blue-500 text-white rounded">Toggle</button>
        <div x-show="openCollapse" x-transition class="p-4 bg-gray-100 rounded mt-2">Collapsible Content</div>
    </section>

    {{-- 18. Image Gallery --}}
    <section>
        <h2 class="font-semibold mb-2">18. Image Gallery</h2>
        <div class="grid grid-cols-3 gap-2">
            <template x-for="n in 6" :key="n">
                <img :src="'https://picsum.photos/seed/' + n + '/200'" class="rounded">
            </template>
        </div>
    </section>

    {{-- 19. Stepper --}}
    <section>
        <h2 class="font-semibold mb-2">19. Stepper</h2>
        <div class="mb-2">Step <span x-text="step"></span> of 3</div>
        <button @click="if(step<3) step++" class="px-3 py-1 bg-green-500 text-white rounded">Next</button>
        <button @click="if(step>1) step--" class="px-3 py-1 bg-gray-300 rounded">Back</button>
    </section>

    {{-- 20. Livewire Integration --}}
    <section>
        <h2 class="font-semibold mb-2">20. Livewire Call</h2>
        <button x-on:click="$wire.call('showAlert')" class="px-3 py-1 bg-purple-600 text-white rounded">Call
            Livewire</button>
    </section>

    {{-- 21. File Upload Preview --}}
    <section>
        <h2 class="font-semibold mb-2">21. File Upload Preview</h2>
        <input type="file" @change="fileName = $event.target.files[0].name" class="border px-3 py-1 rounded">
        <p class="mt-2" x-show="fileName">Selected: <span x-text="fileName"></span></p>
    </section>

    {{-- 22. Tag Input --}}
    <section>
        <h2 class="font-semibold mb-2">22. Tag Input</h2>
        <div class="flex flex-wrap gap-2">
            <template x-for="(tag, index) in tags" :key="index">
                <span class="bg-blue-200 px-2 py-1 rounded">
                    <span x-text="tag"></span>
                    <button @click="tags.splice(index, 1)">x</button>
                </span>
            </template>
        </div>
        <input x-model="newTag" @keydown.enter.prevent="tags.push(newTag); newTag=''" placeholder="Add tag"
            class="border px-2 py-1 rounded mt-2">
    </section>

    {{-- 23. Toggle Switch --}}
    <section>
        <h2 class="font-semibold mb-2">23. Toggle Switch</h2>
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" x-model="toggleSwitch" class="hidden">
            <span class="w-12 h-6 bg-gray-300 rounded-full p-1 flex items-center"
                :class="toggleSwitch ? 'bg-green-500' : 'bg-gray-300'">
                <span class="bg-white w-4 h-4 rounded-full transform"
                    :class="toggleSwitch ? 'translate-x-6' : ''"></span>
            </span>
        </label>
    </section>

    {{-- 24. Range Slider --}}
    <section>
        <h2 class="font-semibold mb-2">24. Range Slider</h2>
        <input type="range" min="0" max="100" x-model="rangeValue" class="w-full">
        <p>Value: <span x-text="rangeValue"></span></p>
    </section>

    {{-- 25. Multi Select --}}
    <section>
        <h2 class="font-semibold mb-2">25. Multi Select</h2>
        <select multiple x-model="multiSelect" class="border px-2 py-1 rounded">
            <option value="Option 1">Option 1</option>
            <option value="Option 2">Option 2</option>
            <option value="Option 3">Option 3</option>
        </select>
        <p class="mt-2">Selected: <span x-text="multiSelect"></span></p>
    </section>

    {{-- 26. Date Picker --}}
    <section>
        <h2 class="font-semibold mb-2">26. Date Picker</h2>
        <input type="date" x-model="dateValue" class="border px-2 py-1 rounded">
        <p class="mt-2">Selected Date: <span x-text="dateValue"></span></p>
    </section>

    {{-- 27. Time Picker --}}
    <section>
        <h2 class="font-semibold mb-2">27. Time Picker</h2>
        <input type="time" x-model="timeValue" class="border px-2 py-1 rounded">
        <p class="mt-2">Selected Time: <span x-text="timeValue"></span></p>
    </section>

    {{-- 28. Character Counter --}}
    <section>
        <h2 class="font-semibold mb-2">28. Character Counter</h2>
        <textarea x-model="charCount" maxlength="100" class="border px-2 py-1 rounded w-full"></textarea>
        <p><span x-text="charCount.length"></span>/100 characters</p>
    </section>

    {{-- 29. Image Lightbox --}}
    <section>
        <h2 class="font-semibold mb-2">29. Image Lightbox</h2>
        <div class="grid grid-cols-3 gap-2">
            <template x-for="n in 3" :key="n">
                <img :src="'https://picsum.photos/seed/' + n + '/200'" class="cursor-pointer"
                    @click="selectedImage = 'https://picsum.photos/seed/'+n+'/600'">
            </template>
        </div>
        <div x-show="selectedImage" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center"
            @click="selectedImage=''">
            <img :src="selectedImage" class="rounded max-w-full max-h-full">
        </div>
    </section>

    {{-- 30. JSON Viewer --}}
    <section>
        <h2 class="font-semibold mb-2">30. JSON Viewer</h2>
        <pre class="bg-gray-200 p-2 rounded text-sm"><code x-text="JSON.stringify(jsonData, null, 2)"></code></pre>
    </section>

    {{-- 31. Sticky Header --}}
    <section>
        <h2 class="font-semibold mb-2">31. Sticky Header</h2>
        <div class="sticky top-0 bg-yellow-300 p-2">I stay at the top when scrolling</div>
        <div style="height:300px"></div>
    </section>

    {{-- 32. Notification Bell --}}
    <section>
        <h2 class="font-semibold mb-2">32. Notification Bell</h2>
        <div class="relative">
            <button class="text-3xl">🔔</button>
            <span x-show="notificationCount > 0"
                class="absolute top-0 right-0 bg-red-500 text-white rounded-full px-2 py-0.5 text-xs"
                x-text="notificationCount"></span>
        </div>
    </section>

    {{-- 33. Currency Input --}}
    <section>
        <h2 class="font-semibold mb-2">33. Currency Input</h2>
        <input x-model="currency" @input="currency = currency.replace(/[^0-9]/g, '')"
            class="border px-2 py-1 rounded" placeholder="Enter amount">
    </section>

    {{-- 34. Auto-resize Textarea --}}
    <section>
        <h2 class="font-semibold mb-2">34. Auto-resize Textarea</h2>
        <textarea x-model="textarea"
            @input="$event.target.style.height = 'auto'; $event.target.style.height = $event.target.scrollHeight + 'px'"
            class="border px-2 py-1 rounded w-full"></textarea>
    </section>

    {{-- 35. Checkbox Group --}}
    <section>
        <h2 class="font-semibold mb-2">35. Checkbox Group</h2>
        <label><input type="checkbox" x-model="checkAll"
                @change="selectedCheckboxes = checkAll ? ['A','B','C'] : []"> Select All</label>
        <div>
            <label><input type="checkbox" value="A" x-model="selectedCheckboxes"> A</label>
            <label><input type="checkbox" value="B" x-model="selectedCheckboxes"> B</label>
            <label><input type="checkbox" value="C" x-model="selectedCheckboxes"> C</label>
        </div>
        <p>Selected: <span x-text="selectedCheckboxes"></span></p>
    </section>

    {{-- 36. Popover --}}
    <section>
        <h2 class="font-semibold mb-2">36. Popover</h2>
        <div class="relative inline-block">
            <button @click="popover = !popover" class="px-4 py-2 bg-gray-700 text-white rounded">Info</button>
            <div x-show="popover" x-transition class="absolute bg-white border p-2 rounded shadow w-48 mt-1">This is a
                popover example.</div>
        </div>
    </section>

    {{-- 37. Badge --}}
    <section>
        <h2 class="font-semibold mb-2">37. Badge</h2>
        <span class="bg-blue-500 text-white px-2 py-0.5 rounded" x-text="badgeText"></span>
    </section>

    {{-- 38. Pagination --}}
    <section>
        <h2 class="font-semibold mb-2">38. Pagination</h2>
        <div class="flex space-x-2">
            <button @click="if(currentPage>1) currentPage--" class="px-3 py-1 bg-gray-200 rounded">Prev</button>
            <span>Page <span x-text="currentPage"></span> of <span x-text="totalPages"></span></span>
            <button @click="if(currentPage<totalPages) currentPage++"
                class="px-3 py-1 bg-gray-200 rounded">Next</button>
        </div>
    </section>

    {{-- 39. Table Sorting --}}
    <section x-data="{ sortAsc: true, rows: [{ name: 'Apple' }, { name: 'Banana' }, { name: 'Cherry' }] }">
        <h2 class="font-semibold mb-2">39. Table Sorting</h2>
        <table class="w-full border">
            <thead>
                <tr>
                    <th @click="rows.sort((a,b)=>sortAsc ? a.name.localeCompare(b.name) : b.name.localeCompare(a.name)); sortAsc=!sortAsc"
                        class="cursor-pointer">Name</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="row in rows" :key="row.name">
                    <tr>
                        <td class="border px-2 py-1" x-text="row.name"></td>
                    </tr>
                </template>
            </tbody>
        </table>
    </section>

    {{-- 40. Table Filtering --}}
    <section x-data="{ filterText: '', rows: ['Apple', 'Banana', 'Cherry'] }">
        <h2 class="font-semibold mb-2">40. Table Filtering</h2>
        <input x-model="filterText" placeholder="Filter" class="border px-2 py-1 rounded mb-2">
        <ul>
            <template x-for="row in rows.filter(r => r.toLowerCase().includes(filterText.toLowerCase()))"
                :key="row">
                <li x-text="row"></li>
            </template>
        </ul>
    </section>

    {{-- 41. Infinite Scroll Simulation --}}
    <section x-data="{ list: [1, 2, 3], loadMore() { let len = this.list.length; for (let i = len + 1; i <= len + 3; i++) { this.list.push(i); } } }">
        <h2 class="font-semibold mb-2">41. Infinite Scroll Simulation</h2>
        <ul>
            <template x-for="item in list" :key="item">
                <li x-text="'Item '+item"></li>
            </template>
        </ul>
        <button @click="loadMore" class="px-3 py-1 bg-gray-200 mt-2 rounded">Load More</button>
    </section>

    {{-- 42. Kanban Board --}}
    <section x-data="{ todos: ['Task 1', 'Task 2'], done: [] }">
        <h2 class="font-semibold mb-2">42. Kanban Board</h2>
        <div class="flex gap-4">
            <div class="w-1/2 bg-gray-100 p-2">
                <h3>Todo</h3>
                <template x-for="(t,i) in todos" :key="i">
                    <div class="bg-white p-2 rounded mb-2">
                        <span x-text="t"></span>
                        <button @click="done.push(t); todos.splice(i,1)"
                            class="ml-2 text-sm text-green-600">Done</button>
                    </div>
                </template>
            </div>
            <div class="w-1/2 bg-green-100 p-2">
                <h3>Done</h3>
                <template x-for="d in done" :key="d">
                    <div class="bg-white p-2 rounded mb-2" x-text="d"></div>
                </template>
            </div>
        </div>
    </section>

    {{-- 43. Status Indicator --}}
    <section>
        <h2 class="font-semibold mb-2">43. Status Indicator</h2>
        <span class="inline-block w-3 h-3 rounded-full" :class="toggleSwitch ? 'bg-green-500' : 'bg-red-500'"></span>
        <span x-text="toggleSwitch ? 'Online' : 'Offline'"></span>
    </section>

    {{-- 44. Fade Animation --}}
    <section x-data="{ show: true }">
        <h2 class="font-semibold mb-2">44. Fade Animation</h2>
        <button @click="show=!show" class="px-3 py-1 bg-gray-200 rounded">Toggle</button>
        <div x-show="show" x-transition.opacity class="p-4 bg-blue-200 rounded mt-2">Fading Box</div>
    </section>

    {{-- 45. Slide Animation --}}
    <section x-data="{ open: true }">
        <h2 class="font-semibold mb-2">45. Slide Animation</h2>
        <button @click="open=!open" class="px-3 py-1 bg-gray-200 rounded">Toggle</button>
        <div x-show="open" x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 transform -translate-y-5"
            x-transition:enter-end="opacity-100 transform translate-y-0" class="p-4 bg-green-200 rounded mt-2">Sliding
            Box</div>
    </section>

    {{-- 46. Scale Animation --}}
    <section x-data="{ visible: true }">
        <h2 class="font-semibold mb-2">46. Scale Animation</h2>
        <button @click="visible=!visible" class="px-3 py-1 bg-gray-200 rounded">Toggle</button>
        <div x-show="visible" x-transition.scale class="p-4 bg-yellow-200 rounded mt-2">Scaling Box</div>
    </section>

    {{-- 47. Rotate Animation --}}
    <section>
        <h2 class="font-semibold mb-2">47. Rotate Animation</h2>
        <div class="w-16 h-16 bg-blue-500 rounded transform transition-transform duration-500 hover:rotate-180"></div>
    </section>

    {{-- 48. Scroll Reveal --}}
    <section x-data x-intersect="$el.classList.add('bg-green-300')" class="p-4 bg-gray-200 rounded">
        <h2 class="font-semibold mb-2">48. Scroll Reveal</h2>
        Scroll to reveal this box (needs Alpine Intersect plugin).
    </section>

    {{-- 49. Livewire Loading State --}}
    <section>
        <h2 class="font-semibold mb-2">49. Livewire Loading State</h2>
        <div wire:loading>Loading from Livewire...</div>
    </section>

    {{-- 50. Livewire Polling --}}
    <section wire:poll.5s>
        <h2 class="font-semibold mb-2">50. Livewire Polling</h2>
        <p>Time: {{ now() }}</p>
    </section>

</div>
