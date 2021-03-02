<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Peliculas') }}
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

        
        <div class="card">
            <form method="POST" action="{{ route('movie.update',['id'=> $movie->id]) }}" class="p-5" enctype="multipart/form-data">
                @csrf


                <!-- titulo -->
                <div class="mt-4">
                    <x-label for="title" :value="__('Título')" />

                    <x-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $movie->title }}" required/>
                </div>

                <!-- release -->
                <div class="mt-4">
                    <x-label for="estreno" :value="__('Estreno')" />

                    <x-input id="release" class="block mt-1 w-full" type="text" name="release" required placeholder="AAAA-MM-DD" value="{{ $movie->release }}"/>
                </div>

                <!-- DIRECTOR -->
                <div class="mt-4">
                    <x-label for="director" :value="__('Director')" />

                    <x-input id="director" class="block mt-1 w-full" type="text" name="director" required  value="{{ $movie->director }}"/>
                </div>
                <br>

                <img src="{{ route('movie.poster', ['filename'=> $movie->poster])  }}" class="avatar">
                <!--POSTER-->
                <div class="mt-4">
                    <x-label for="poster" :value="__('Poster promocional')" />

                    <x-input id="poster" class="block mt-1 w-full" type="file" name="poster" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-4">
                        {{ __('Editar') }}
                    </x-button>
                </div>
            </form>
        </div>
       
    </div>

</x-app-layout>