<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Configuracion de mi cuenta') }}
        </h2>
    </x-slot>


   
    
    <div class="p-20 center-block">
    <x-auth-validation-errors class="p-20 center-block" :errors="$errors" />

        @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif

        @if(session('errorMessage'))
        <div class="alert alert-danger">
            {{ session('errorMessage') }}
        </div>
        @endif



        <form method="POST" action="{{ route('user.update',['id'=> Auth::user()->id]) }}" enctype="multipart/form-data">
            @csrf

            

            <!--Full Name -->
            <div>
                <x-label for="fullname" :value="__('Nombre Completo')" />

                <x-input id="fullname" class="block mt-1 w-full" type="text" name="fullname" value="{{ Auth::user()->fullname }}" autofocus />
            </div>

            <!-- Nick -->
            <div class="mt-4">
                <x-label for="nick" :value="__('Nickname')" />

                <x-input id="nick" class="block mt-1 w-full" type="text" name="nick" value="{{ Auth::user()->nick }}" autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ Auth::user()->email }}" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Nueva contraseña')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirma nueva Contraseña')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" />
            </div>
            
            <br>
            @include('includes.avatar')
            <div class="mt-4">
                <x-label for="avatar" :value="__('Avatar')" />

                <x-input id="avatar" class="block mt-1 w-full" type="file" name="avatar" />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4">
                    {{ __('Actualizar') }}
                </x-button>
            </div>
        </form>
    </div>

</x-app-layout>