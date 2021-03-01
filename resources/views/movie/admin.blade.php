<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Peliculas') }}
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
            <div class="card-header font-semibold text-xl text-gray-800 leading-tight">Añadir Pelicula</div>
            <form method="POST" action="{{ route('movie.save') }}" class="p-5" enctype="multipart/form-data">
                @csrf

                <!-- titulo -->
                <div class="mt-4">
                    <x-label for="title" :value="__('Título')" />

                    <x-input id="title" class="block mt-1 w-full" type="text" name="title" required />
                </div>

                <!-- release -->
                <div class="mt-4">
                    <x-label for="estreno" :value="__('Estreno')" />

                    <x-input id="release" class="block mt-1 w-full" type="text" name="release" required placeholder="AAAA-MM-DD" />
                </div>

                <!-- DIRECTOR -->
                <div class="mt-4">
                    <x-label for="director" :value="__('Director')" />

                    <x-input id="director" class="block mt-1 w-full" type="text" name="director" required />
                </div>
                
                <!--POSTER-->
                <div class="mt-4">
                    <x-label for="poster" :value="__('Poster promocional')" />

                    <x-input id="poster" class="block mt-1 w-full" type="file" name="poster" />
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