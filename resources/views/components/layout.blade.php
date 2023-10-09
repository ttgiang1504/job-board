{{-- layout: hiển thị giao diện, bố cục trang web --}}

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel Job Board</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        {{-- @vite('resources/css/app.css')
        @vite('resources/js/app.js') --}}
    </head>
    <body class="from-10% via-30% to-90% mx-auto mt-10 max-w-2xl bg-gradient-to-r from-indigo-100  via-sky-100 to-emerald-100  text-sl-700 ">
        <nav class="mb-8 flex justify-between text-lg font-medium">
            <ul>
                <li>
                    <a href="{{ route('jobs.index')}}">Home</a>
                </li>
            </ul>
            <ul class="flex space-x-4">
                @auth
                    <li>
                        <a href="{{ route('my-job-applications.index')}}">
                            {{ auth()->user()->name ?? 'Anonymous'}} Apply
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('auth.destroy') }}" method="post">
                            @csrf
                            @method('delete')
                            <button>Log Out</button>
                        </form>
                    </li>
                @else
                    <li>
                        <a href="{{ route('auth.create') }}">Sign In</a> 
                    </li>
                    <li>
                        <a href="{{ route('user.register') }}">Register</a> 
                    </li>
                @endauth
                
                <li></li>
            </ul>
        </nav>
        @if (session('success'))
            <div role="alert" class="flex space-x-2 my-8 rounded-md border-l-4 border-green-500 bg-green-100 p-4 text-green-700 opacity-75">
                <p class="font-bold"> Success!</p>
                <p>{{ session('success')}}</p>
            </div>
        @endif
        {{ $slot }}
    </body>
</html>
