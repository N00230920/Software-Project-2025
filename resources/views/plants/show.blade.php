<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Explore Plants') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            <x-plant-details
                                :name="$plant->name"
                                :image="$plant->image"
                                :species="$plant->species"
                                :info="$plant->info"
                            />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>