<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.index')">
                        {{ __('Posts') }}
                    </x-nav-link>
                </div>
                @auth
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('profile.show', Auth::id())" :active="request()->routeIs('profile.show')">
                        {{ __('Profile Corner') }}
                    </x-nav-link>
                </div>
                @endauth
            </div>

            @auth
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                
                @auth
                    <div class="relative">
                        <button id="notif-count" class="relative bg-gray-200 px-3 py-2 rounded">
                            🔔 Notifications ({{ auth()->user()->unreadNotifications->count() }})
                        </button>

                        <div id="notification-list" class="absolute right-0 mt-2 w-64 bg-white shadow-lg rounded hidden">
                            <ul>
                                @if (Auth::user()->unreadNotifications->count() == 0)
                                    <li class="border-b px-4 py-2 text-center">
                                        No new notifications
                                    </li>
                                @else
                                    
                                @endif
                                @foreach(auth()->user()->unreadNotifications as $notification)
                                    <li class="border-b px-4 py-2">
                                        <a href="{{ route('notifications.read', $notification->id) }}">
                                            {{ $notification->data['message'] }}
                                            <p class="text-sm text-gray-700">{{ $notification->created_at }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    {{-- <div x-data="{ open: false }" class="relative">
                        <div x-data='{ notifications: @json(auth()->user()->unreadNotifications) }'>
                            <button @click="open = !open" class="relative px-4 py-2 bg-gray-800 text-white rounded">
                                Notifications
                                <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-2" x-show="notifications.length > 0" x-text="notifications.length">
                                    <span id="notif-count">0</span>
                                </span>
                            </button>
                    
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-64 bg-white shadow-md rounded p-2" x-ref="notifList">
                                <template x-for="(notification, index) in notifications" :key="notification.id">
                                    <div class="p-2 border-b last:border-none cursor-pointer" @click="markAsRead(notification.id, index)">
                                        <p class="text-sm text-gray-700" x-text="notification.data.message"></p>
                                        <p class="text-xs text-gray-500" x-text="new Date(notification.created_at).toLocaleString()"></p>
                                    </div>
                                </template>
                                <p class="text-center text-gray-500 text-sm" x-show="notifications.length === 0">No new notifications</p>
                            </div>
                        </div>
                    </div> --}}
                    
                    {{-- <script>
                        function markAsRead(id, index) {
                            notifications: @json(auth()->user()->unreadNotifications)
                            fetch(`notifications/read/${id}`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json'
                                }
                            }).then(response => response.json()).then(data => {
                                if(data.success) {
                                    notifications.splice(index, 1);
                                }
                            });
                        }
                    </script> --}}
                    
                    <script>
                        document.getElementById('notif-count').addEventListener('click', function() {
                            document.getElementById('notification-list').classList.toggle('hidden');
                        });
                    </script>
                @endauth

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Edit Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @endauth

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        @auth
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>
