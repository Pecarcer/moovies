<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Reseña') }}
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

        @if(session('errorMessage'))
        <div class="alert alert-danger">
            {{ session('errorMessage') }}
        </div>
        @endif

        <div class="card">
            
            <form method="POST" action="{{ route('review.update',['id'=> $review->id]) }}" class="p-5">
                @csrf

                <!--Usuario-->
                <div>
                    <label for="usuario" :value="__('Usuario')" />

                    <select id="usuario" class="block mt-1 w-full" name="usuario">
                        <option disabled> --Seleccione un Usuario--</option>";
                        @foreach($userList as $user)
                        <option value="{{ $user->id}}"  @if($user->id==$review->user_id) selected @endif > {{ $user->nick}}</option>
                        @endforeach
                    </select>

                </div> <br>

                <!--Movie -->
                <div>
                    <label for="movie" :value="__('Pelicula')" />

                    <select id="movie" class="block mt-1 w-full" name="movie">
                        <option selected disabled> --Seleccione una Pelicula--</option>";
                        @foreach($movieList as $movie)
                        <option value="{{ $movie->id}}" @if($movie->id==$review->movie_id) selected @endif > {{ $movie->title}}</option>
                        @endforeach
                    </select>

                </div> <br>

                <!--Score -->
                <div>
                    <x-label for="score" :value="__('Nota')" />

                    <x-input id="score" class="block mt-1 w-full" type="text" name="score" value="{{ $review->score }}" autofocus />
                </div>

                <!-- Opinion -->
                <div class="mt-4">
                    <x-label for="opinion" :value="__('Opinion')" />

                    <x-input id="opinion" class="block mt-1 w-full" type="text" name="opinion" value="{{ $review->opinion }}" autofocus />
                </div>

                <div class="flex items-center justify-end mt-4">

                    <x-button class="ml-4">
                        {{ __('Actualizar') }}
                    </x-button>
                </div>
            </form>
        </div>

</x-app-layout>