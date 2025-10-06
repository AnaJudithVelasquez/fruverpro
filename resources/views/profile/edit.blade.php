<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-700 leading-tight">
            {{ __('Perfil de Usuario') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- ✅ Actualizar información de perfil -->
            <div class="p-6 bg-white shadow-lg rounded-2xl">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Actualizar información del perfil</h3>

                @if (session('status') === 'profile-updated')
                    <div class="p-3 mb-4 text-green-700 bg-green-100 rounded-md">
                        ✅ Perfil actualizado correctamente.
                    </div>
                @endif

                <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
                    @csrf
                    @method('patch')

                    <!-- Nombre -->
                    <div>
                        <x-input-label for="name" :value="__('Nombre completo')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500" :value="old('name', $user->name)" required autofocus />
                        <x-input-error class="mt-2 text-red-500" :messages="$errors->get('name')" />
                    </div>

                    <!-- Correo electrónico -->
                    <div>
                        <x-input-label for="email" :value="__('Correo electrónico')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500" :value="old('email', $user->email)" required autocomplete="username" />
                        <x-input-error class="mt-2 text-red-500" :messages="$errors->get('email')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button class="bg-green-600 hover:bg-green-700">
                            Guardar cambios
                        </x-primary-button>

                        @if (session('status') === 'profile-updated')
                            <p class="text-sm text-gray-600">Cambios guardados.</p>
                        @endif
                    </div>
                </form>
            </div>

            <!-- ✅ Cambiar contraseña -->
            <div class="p-6 bg-white shadow-lg rounded-2xl">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Cambiar contraseña</h3>

                <form method="post" action="{{ route('password.update') }}" class="space-y-5">
                    @csrf
                    @method('put')

                    <div>
                        <x-input-label for="current_password" :value="__('Contraseña actual')" />
                        <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500" autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('current_password')" class="mt-2 text-red-500" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Nueva contraseña')" />
                        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirmar nueva contraseña')" />
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button class="bg-green-600 hover:bg-green-700">
                            Actualizar contraseña
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- ❌ Eliminar cuenta -->
            <div class="p-6 bg-white shadow-lg rounded-2xl border border-red-200">
                <h3 class="text-lg font-medium text-red-600 mb-4">Eliminar cuenta</h3>
                <p class="text-sm text-gray-600 mb-3">
                    Esta acción es irreversible. Todos tus datos serán eliminados permanentemente.
                </p>

                <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('¿Estás seguro de eliminar tu cuenta? Esta acción no se puede deshacer.')">
                    @csrf
                    @method('delete')

                    <div>
                        <x-input-label for="password" :value="__('Confirma tu contraseña')" />
                        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500" required />
                        <x-input-error class="mt-2 text-red-500" :messages="$errors->get('password')" />
                    </div>

                    <div class="mt-4">
                        <x-danger-button class="bg-red-600 hover:bg-red-700">
                            Eliminar cuenta
                        </x-danger-button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
