<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>


    <!-- Validation Errors -->
    <x-auth-validation-errors class="p-20 center-block" :errors="$errors" />
    <div class="p-20 center-block">

        @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif


        <div class="card">
            <div class="card-header font-semibold text-xl text-gray-800 leading-tight">Añadir Usuario</div>
            <form method="POST" action="{{ route('user.save') }}" class="p-5">
                @csrf

                
                <!--Full Name -->
                <div>
                    <x-label for="fullname" :value="__('Nombre Completo')" />

                    <x-input id="fullname" class="block mt-1 w-full" type="text" name="fullname" value="" required autofocus />
                </div>

                <!-- Nick -->
                <div class="mt-4">
                    <x-label for="nick" :value="__('Nickname')" />

                    <x-input id="nick" class="block mt-1 w-full" type="text" name="nick" value="" required autofocus />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="" required />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Contraseña')" />

                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirma Contraseña')" />

                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-4">
                        {{ __('Añadir') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>