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

        @if(session('errorMessage'))
        <div class="alert alert-danger">
            {{ session('errorMessage') }}
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
                    <label for="review" :value="__('Reseña')" />

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

    <div class="p-20 center-block">
        @foreach($userList as $user)
            <div class="card"> 
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Likes de {{$user->nick}}</th>
                                <th class="py-3 px-6 text-left">Autor</th>
                                <th class="py-3 px-6 text-center">Pelicula</th>
                                <th class="py-3 px-6 text-center">Reseña</th>
                                <th class="py-3 px-6 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">

                            @foreach($likes as $like)
                                @if($like->user_id == $user->id)
                                    @foreach($reviewList as $review)
                                        @if($like->review_id == $review->id)
                                            <tr class="text-center">
                                                <td class="text-center"></td>
                                                <td class="text-center">{{ $review->user->nick }}</td>
                                                <td class="text-center">{{ $review->movie->title }}</td>
                                                <td class="text-center">{{ $review->opinion}}</td>
                                                <td>
                                                <a href="{{ route('likes.delete', ['id'=> $like->id]) }}"> <i class="fas fa-trash fa-2x"></i></a>
                                                        &nbsp;
                                                        &nbsp;
                                                        <a href="{{ route('likes.edit', ['id'=> $like->id]) }}"> <i class="fas fa-pencil-alt fa-2x"> </i> </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </tbody>
                    </table>
            </div>
        <br><br>
        @endforeach
    </div>




</x-app-layout>

<!--
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



-->