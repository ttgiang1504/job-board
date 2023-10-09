<x-layout>
    <h1 class="my-16 text-center text-4xl font-medium text-slate-600">
        Sign in to your account
    </h1>

    <x-card class="py-8 px-16">
        <form action="{{ route('user.register') }}" method="POST">
            @csrf
      
            <div class="mb-8">
                <label for="name"
                  class="mb-2 block text-sm font-medium text-slate-900">Name</label>
                <x-text-input name="name" value="{{old('name')}}" />
                @error('name')
                    <div class="mt-2 text-red-500 text-sm font-medium bg-slate-300">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-8">
              <label for="email"
                class="mb-2 block text-sm font-medium text-slate-900">E-mail</label>
              <x-text-input name="email" value="{{old('email')}}" />
              @error('email')
                    {{$message}}
              @enderror
            </div>
      
            <div class="mb-8">
              <label for="password" class="mb-2 block text-sm font-medium text-slate-900">
                Password
              </label>
              <x-text-input name="password" type="password" value="{{old('password')}}" />
              @error('password')
                    {{$message}}
              @enderror
            </div>

            <x-button class="w-full mb-3"> Register </x-button>
            <p class="text-sm font-medium">Do you have an account?<a class=" ml-2 text-indigo-600 hover:underline" href="{{ route('auth.create')}}"> Sign in</a></p>
    </x-card>
</x-layout>