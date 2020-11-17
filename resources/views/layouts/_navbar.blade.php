<nav class="h-16 bg-white shadow flex items-center">
    <div class="container mx-auto px-6 relative">
        <div class="flex justify-between">
            <!-- Search -->
            <input
                class="w-64 px-3 py-1 bg-gray-100 border border-gray-400 rounded-lg outline-none placeholder-gray-600 focus:bg-white focus:shadow"
                type="text"
                name="query"
                id="query"
                placeholder="Search"
            />

            <div x-data="{ open: false }">
                <!-- Dropdown button -->
                <button @click="open = true" class="block flex items-center cursor-pointer focus:outline-none">
                    <img class="h-8 w-8 mr-1 rounded-full object-cover" src="https://www.w3schools.com/w3css/img_avatar6.png" />

                    <svg class="w-5 h-5 text-gray-700 transform" :class="{'rotate-180': open}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div x-show="open" @click.away="open = false" class="py-1 w-48 absolute right-0 mt-6 mr-4 bg-white rounded shadow-lg">
                    <a href="#" class="block px-4 py-1 outline-none hover:bg-gray-200 focus:bg-gray-300">My Account</a>
                    <a @click="document.querySelector('#logout-form').submit();" href="#" class="block px-4 py-1 outline-none hover:bg-gray-200 focus:bg-gray-300">Sign out</a>
                </div>
            </div>

            <!-- Logout form -->
            <form id="logout-form" action="{{ route('moon.auth.logout') }}" method="post" class="hidden">@csrf</form>
        </div>
    </div>
</nav>