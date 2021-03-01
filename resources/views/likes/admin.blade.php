<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Likes') }}
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
            <div class="card-header font-semibold text-xl text-gray-800 leading-tight">Añadir Likes</div>
            <form method="POST" action="{{ route('likes.save') }}" class="p-5">
                @csrf

                <!-- Usuario -->
                <div>
                    <label for="user" :value="__('Usuario')" />

                    <select id="user" class="block mt-1 w-full" name="user">
                        <option selected disabled> --Seleccione un Usuario--</option>";
                        @foreach($userList as $user)
                        <option value="{{ $user->id}}"> {{ $user->nick}}</option>
                        @endforeach
                    </select>

                </div>

                <!-- Reseña -->

                <div>
                    <label for="movie" :value="__('Reseña')" />

                    <select id="review" class="block mt-1 w-full" name="review">
                        <option selected disabled> --Seleccione una Reseña--</option>";
                        @foreach($reviewList as $review)
                        <option value="{{ $review->id}}"> Usuario: {{ $review->user->nick }} // Pelicula: {{ $review->movie->title }} // Reseña: {{ $review->opinion}}</option>
                        @endforeach
                    </select>

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