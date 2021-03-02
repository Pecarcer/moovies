<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
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
        
       <!-- component -->
        <div class="overflow-x-auto">
            <div class="min-w-screen min-h-screen bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
                <div class="w-full lg:w-5/6">
                    <div class="bg-white shadow-md rounded my-6">                  

                    <div class="row">
                        <div class="col-md-6">
                            Filtrado por rol:
                            <a href="/users/?role=admin">Admins</a> |
                            <a href="/users/?role=user">Users</a> |
                            <a href="/users">Todos</a>
                        </div>
                        <div class="col-md-6 text-right">
                            Orden:
                                <a href="{{ route('user.admin', ['role' => request('role'), 'sort' => 'asc']) }}"> Ascendente</a>
                                <a href="{{ route('user.admin', ['role' => request('role'), 'sort' => 'desc']) }}"> Descendente</a>
                        
                        </div>
                    </div>


                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Id</th>
                                    <th class="py-3 px-6 text-left">Nick</th>
                                    <th class="py-3 px-6 text-center">Email</th>
                                    <th class="py-3 px-6 text-center">Rol</th>
                                    <th class="py-3 px-6 text-center">Nombre Completo</th>
                                    <th class="py-3 px-6 text-center">Avatar</th>
                                    <th class="py-3 px-6 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">

                                @foreach($userList as $user)



                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="font-medium">{{$user->id}}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-center">

                                            <span>{{$user->nick}}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <span>{{$user->email}}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        @if($user->role == 'admin')
                                        <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs"> Admin</span>
                                        @else
                                        <span class="bg-blue-200 text-purple-600 py-1 px-3 rounded-full text-xs"> User</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <span> {{$user->fullname}} </span>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <span>

                                                @if($user->avatar)
                                                <img src="{{ route('user.avatar',['filename'=>$user->avatar]) }}" class="iconosLista" width="25" height="25">
                                                @endif

                                            </span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        @if($user->id!=Auth::user()->id)
                                        <div class="flex item-center justify-center">
                                        <a href="{{ route('user.delete', ['id'=> $user->id]) }}"> <i class="fas fa-trash fa-2x"></i></a>
                                        &nbsp;
                                        &nbsp;
                                        <a href="{{ route('user.edit', ['id'=> $user->id]) }}"> <i class="fas fa-pencil-alt fa-2x"> </i> </a>
                                  
                                        </div>
                                        @endif
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                        {{ $userList->links() }}
                        
                    </div>
                </div>
            </div>
        </div> <!-- fin tabla-->

        <div class="card">
            <div class="card-header font-semibold text-xl text-gray-800 leading-tight">Añadir Usuario</div>
            <form method="POST" action="{{ route('user.save') }}" class="p-5">
                @csrf

                <!--Full Name -->
                <div>
                    <x-label for="fullname" :value="__('Nombre Completo')" />

                    <x-input id="fullname" class="block mt-1 w-full" type="text" name="fullname" value="" required autofocus />
                </div>

                <!-- Nick -->
                <div class="mt-4">
                    <x-label for="nick" :value="__('Nickname')" />

                    <x-input id="nick" class="block mt-1 w-full" type="text" name="nick" value="" required autofocus />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="" required />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Contraseña')" />

                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirma Contraseña')" />

                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
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