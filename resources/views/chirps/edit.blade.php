<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Chirp') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('chirps.update', $chirp) }}">
                    <!-- @csrf : si o si para un formulario
                           @method('put') : metodo utilizado para poder enciar los datos a la ruta update -->
                    @csrf @method('put')
                    <textarea name="messege" class="block w-full rounded-md shadow-lg"
                            placeholder="¿Que estas pensando?">{{ old('messege', $chirp->messege)}}</textarea>
                        <x-input-error :messages="$errors->get('messege')"/>
                        <x-primary-button class="mt-4">chirps</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>