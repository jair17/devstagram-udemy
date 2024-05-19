<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('styles')
    @vite('resources/css/app.css')
    <title>DevStagram - @yield('title')</title>
    @vite('resources/js/app.js')
    @livewireStyles
</head>
<body class="bg-gray-100">
<header class="p-5 border-b bg-white shadow">
    <div class="container mx-auto flex justify-between items-center">
        @auth()
            <a href="{{route('home')}}"><h1 class="text-3xl font-black">
                    DevStagram
                </h1></a>

            <nav class="flex gap-2 items-center">
                <div class="relative inline-block text-left">
                    <button id="dropdownNotificationButton" class="relative inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-900 focus:outline-none" type="button">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 20">
                            <path d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z"/>
                        </svg>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                        <div class="absolute block w-3 h-3 bg-red-500 border-2 border-white rounded-full -top-0.5 start-2.5"></div>
                        @endif
                    </button>

                    <div id="dropdownNotification" class="hidden absolute right-0 mt-2 w-80 bg-white divide-y divide-gray-100 rounded-lg shadow-lg">
                        <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50">
                            {{ __('Notifications') }} <span class="text-xs text-gray-500">{{ auth()->user()->unreadNotifications->count() }} {{ __('news') }}</span>
                        </div>
                        @forelse(auth()->user()->unreadNotifications as $notification)
                            <div class="divide-y divide-gray-100">
                                <a href="{{ $notification->data['link'] }}" class="flex px-4 py-3 hover:bg-gray-100">
                                    <div class="flex-shrink-0">
                                        <div class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-blue-600 border border-white rounded-full ">
                                            <svg class="w-2 h-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                                <path d="M1 18h16a1 1 0 0 0 1-1v-6h-4.439a.99.99 0 0 0-.908.6 3.978 3.978 0 0 1-7.306 0 .99.99 0 0 0-.908-.6H0v6a1 1 0 0 0 1 1Z"/>
                                                <path d="M4.439 9a2.99 2.99 0 0 1 2.742 1.8 1.977 1.977 0 0 0 3.638 0A2.99 2.99 0 0 1 13.561 9H17.8L15.977.783A1 1 0 0 0 15 0H3a1 1 0 0 0-.977.783L.2 9h4.239Z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="w-full ps-3">
                                        <div class="text-gray-500 text-sm mb-1.5"><span class="font-semibold text-gray-900 ">{{$notification->data['username']}} </span>{{$notification->data['message']}}</div>
                                        <div class="text-xs text-blue-600 ">{{ $notification->created_at->diffForHumans() }}</div>
                                    </div>
                                </a>
                            </div>
                            @empty
                                <p class="text-sm p-8 font-normal text-center">{{'None notifications'}}</p>
                        @endforelse
                        <a href="#" class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100">
                            <div class="inline-flex items-center">
                                <svg class="w-4 h-4 me-2 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                    <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                                </svg>
                                View all
                            </div>
                        </a>
                    </div>
                </div>
                <a href="{{route('posts.create')}}"
                   class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z"/>
                    </svg>
                    Crear
                </a>
                <a href="{{route('posts.index',auth()->user()->username)}}"
                   class="font-bold uppercase text-gray-600 text-sm">
                    Hola: <span class="font-normal">{{ auth()->user()->username }}</span>
                </a>
                <form method="POST" action="{{route('logout')}}">
                    @csrf
                    <button type="submit" class="font-bold uppercase text-gray-600 text-sm">{{__('Logout')}}</button>
                </form>
            </nav>
        @endauth
        @guest()
            <nav class="flex gap-2 items-center">
                <a href="{{route('login')}}" class="font-bold uppercase text-gray-600 text-sm">Login</a>
                <a href="{{route('register')}}" class="font-bold uppercase text-gray-600 text-sm">Crear Cuenta</a>
            </nav>
        @endguest
    </div>
</header>

<main class="container mx-auto mt-10">
    <h2 class="font-black text-center text-3xl mb-10">@yield('title')</h2>
    @yield('content')
</main>

<footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
    DevStagram - {{__('All rights reserved ©')}} {{now()->year}}
</footer>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var notificationButton = document.getElementById('dropdownNotificationButton');
        var notificationDropdown = document.getElementById('dropdownNotification');

        notificationButton.addEventListener('click', function(event) {
            event.stopPropagation();
            notificationDropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', function(event) {
            if (!notificationDropdown.classList.contains('hidden') && !notificationDropdown.contains(event.target) && event.target !== notificationButton) {
                notificationDropdown.classList.add('hidden');
            }
        });
    });
</script>
@livewireScripts
</body>
</html>
