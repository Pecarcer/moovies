<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Likes') }}
        </h2>
    </x-slot>


    <div class="p-20 center-block">    
    <!-- Validation Errors -->
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

        <form method="POST" action="{{ route('likes.update',['id'=> $like->id]) }}">
            @csrf

            <!-- Usuario -->
            <div>
                <label for="usuario" :value="__('Usuario')" />

                <select id="usuario" class="block mt-1 w-full" name="usuario">
                    <option disabled> --Seleccione un Usuario--</option>";
                    @foreach($userList as $user)
                    <option value="{{ $user->id}}" @if($user->id==$like->user_id) selected @endif > {{ $user->nick}}</option>
                    @endforeach
                </select>

            </div>
            <br>

            <!-- Reseña -->

            <div>
                <label for="review" :value="__('Reseña')" />

                <select id="review" class="block mt-1 w-full" name="review">
                    <option  disabled> --Seleccione una Reseña--</option>";
                    @foreach($reviewList as $review)
                    <option value="{{ $review->id}}" @if($review->id==$like->review_id) selected @endif > Usuario: {{ $review->user->nick }} // Pelicula: {{ $review->movie->title }} // Reseña: {{ $review->opinion}}</option>
                    @endforeach
                </select>

            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Actualizar') }}
                </x-button>
            </div>
        </form>
    </div>

</x-app-layout>