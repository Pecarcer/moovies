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


        <!-- component -->
        <div class="overflow-x-auto">
            <div class="min-w-screen min-h-screen bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
                <div class="w-full lg:w-5/6">
                    <div class="bg-white shadow-md rounded my-6">
                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Id</th>
                                    <th class="py-3 px-6 text-left">Titulo</th>
                                    <th class="py-3 px-6 text-center">Estreno</th>
                                    <th class="py-3 px-6 text-center">Director</th>
                                    <th class="py-3 px-6 text-center">Poster</th>
                                    <th class="py-3 px-6 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">

                                @foreach($movieList as $movie)



                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="font-medium">{{$movie->id}}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-center">

                                            <span>{{$movie->title}}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <span>{{$movie->release}}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <span class="flex items-center justify-center"> {{$movie->director}} </span>
                                    </td>

                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <span>

                                                @if($movie->poster)
                                                <img src="{{ route('movie.poster',['filename'=>$movie->poster]) }}" width="80" height="100">
                                                @endif

                                            </span>
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
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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