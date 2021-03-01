<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reseñas') }}
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
        <div class="card-header font-semibold text-xl text-gray-800 leading-tight">Añadir Reseña</div>
        <form method="POST" action="{{ route('review.save') }}" class="p-5">
            @csrf

             <!--Movie -->
             <div>
                <label for="movie" :value="__('Pelicula')" />

                <select id="movie" class="block mt-1 w-full" name="movie" >
                <option selected disabled> --Seleccione una Pelicula--</option>";
                @foreach($movieList as $movie)
                    <option value="{{ $movie->id}}"> {{ $movie->title}}</option>
                @endforeach
                </select>

            </div> <br>

            <!--Score -->
            <div>
                <x-label for="score" :value="__('Nota')" />

                <x-input id="score" class="block mt-1 w-full" type="text" name="score" value="" autofocus />
            </div>

            <!-- Opinion -->
            <div class="mt-4">
                <x-label for="opinion" :value="__('Opinion')" />

                <x-input id="opinion" class="block mt-1 w-full" type="text" name="opinion" value="" autofocus />
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