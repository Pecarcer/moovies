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

        @if(session('errorMessage'))
        <div class="alert alert-danger">
            {{ session('errorMessage') }}
        </div>
        @endif
       
    <div class="card">
        <div class="card-header font-semibold text-xl text-gray-800 leading-tight">Añadir Reseña</div>
        <form method="POST" action="{{ route('review.save') }}" class="p-5">
            @csrf

            <!--Usuario-->
            <div>
                <label for="user" :value="__('Usuario')" />

                <select id="user" class="block mt-1 w-full" name="user" >
                <option selected disabled> --Seleccione un Usuario--</option>";
                @foreach($userList as $user)
                    <option value="{{ $user->id}}"> {{ $user->nick}}</option>
                @endforeach
                </select>

            </div> <br>

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

    
        <!-- component -->
        <div class="overflow-x-auto">
            <div class="min-w-screen min-h-screen bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
                <div class="w-full lg:w-5/6">
                    <div class="bg-white shadow-md rounded my-6">
                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Id</th>
                                    <th class="py-3 px-6 text-left">Usuario</th>
                                    <th class="py-3 px-6 text-center">Pelicula</th>
                                    <th class="py-3 px-6 text-center">Nota</th>
                                    <th class="py-3 px-6 text-center">Opinion</th>
                                    <th class="py-3 px-6 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">

                                @foreach($reviewList as $review)

                               
                                                                
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <span class="font-medium">{{$review->id}}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-left ">
                                            <span>{{ $review->user->nick }}</span>                                            
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <span>{{ $review->movie->title }}</span>                                            
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">                                        
                                        <span class="flex items-center justify-center"> {{$review->score}} </span>  
                                    </td>
                                  
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <span class="flex items-center justify-center"> {{$review->opinion}} </span> 
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">
                                          
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </div>
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <a href="{{ route('review.delete', ['id'=> $review->id]) }}">                                                    
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </a>
                                                </svg>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>