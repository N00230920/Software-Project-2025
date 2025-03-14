<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Explore Plants') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <x-alert-success>
            {{session('success')}}
        </x-alert-success>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($plants as $plant)
                        <a href = "{{ route('plants.show', $plant->id) }}">
                            <x-plant-pin
                                :name="$plant->name"
                                :image="$plant->image"
                                :species="$plant->species"
                                :info="$plant->info"
                            />
                            
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

