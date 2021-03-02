<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="inicio"> 
                <div class="p-4 bg-white border-b border-gray-200" >
                <img class="image-container" src={{asset("storage/welcome.jpg")}} />
                </div>
                </div>
            </div>
        </div>
    </div>

    
    
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Título</th>
      <th scope="col">Nota</th>
      <th scope="col">Estreno</th>
    </tr>
  </thead>
  <tbody>
  @foreach($movieReviews["results"] as $review)
     <tr>
    <td>{{ $review["original_title"] }}</td>
    <td>{{ $review["vote_average"] }}</td>
    <td>{{ $review["release_date"] }}</td>
    </tr>
 @endforeach
  </tbody>
</table>
</x-app-layout>
