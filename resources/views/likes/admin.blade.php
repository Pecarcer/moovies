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
                    <label for="usuario" :value="__('Usuario')" />

                    <select id="usuario" class="block mt-1 w-full" name="usuario">
                        <option selected disabled> --Seleccione un Usuario--</option>";
                        @foreach($userList as $user)
                        <option value="{{ $user->id}}"> {{ $user->nick}}</option>
                        @endforeach
                    </select>

                </div>
                <br>

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

    <div>
        @foreach($userList as $user)
            <div>
                <p> Al usuario {{ $user->nick }} le han gustado las siguientes reviews:</p>
                @foreach($likes as $like)
                    @if($like->user_id == $user->id)
                    -------
                        @foreach($reviewList as $review)
                            @if($like->review_id == $review->id)  
                            Autor: {{ $review->user->nick }}
                            Pelicula: {{ $review->movie->title }}
                            Reseña: {{ $review->opinion}}
                            @endif  

                        @endforeach                      

                    -------    <br>
                    @endif   <br>     
                @endforeach

            </div>
        @endforeach
    </div>

</x-app-layout>