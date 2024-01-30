<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
             Chirp
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('chirps.store') }}">
                    @csrf 
                        <textarea name="messege" class="block w-full rounded-md shadow-lg"
                            placeholder="¿Que estas pensando?">{{ old('messege')}}</textarea>
                        <x-input-error :messages="$errors->get('messege')"/>
                        <x-primary-button class="mt-4">chirps</x-primary-button>
                    </form>
                </div>
            </div>
            <div class="mt-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg divide-y dark:divide-gray-900">
                @foreach($chirps as $chirp)
                    <div class="p-6 flex space-x-2">
                        <svg class="h-6 w-6 text-gray-600 dark:text-gray-400 -scale-x-100" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25"></path>
                        </svg> 
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800 dark:text-gray-200">
                                        {{ $chirp->user->name}}
                                    </span>
                                    <small class="ml-2 text-sm text-gray-600 dark:text-gray-400" >{{ $chirp->created_at->format('j M Y, g:i a') }}</small>
                                    @if ($chirp->created_at != $chirp->updated_at)
                                        <small class="text-sm text-gray-600 dark:text-gray-400" >'editado' </small>
                                    @endif
                                </div>
                                @can('update', $chirp)
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg class="w-5 h-5 " data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"></path>
                                            </svg>          
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('chirps.edit', $chirp)">Editar Chirps</x-dropdown-link>
                                        <form method="post" action="{{ route('chirps.destroy', $chirp) }}">
                                            @csrf @method('delete')
                                            <x-dropdown-link :href="route('chirps.destroy', $chirp)"
                                                onclick="event.preventDefault(); this.closest('form').submit();">destroy Chirps</x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                                @endcan
                            </div>
                            <p class="mt-4 text-lg text-gray-900 dark:text-gray-100">{{ $chirp->messege }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
