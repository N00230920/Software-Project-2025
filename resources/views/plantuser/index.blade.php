<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Plants') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <x-alert-success>
            {{session('success')}}
        </x-alert-success>

        <!-- Display for Plants card components  -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                
                    <!-- Search Form -->
                        <form method="GET" action="{{ url('/search-plant-user') }}" class="mb-4">
                            <select name="location" class="border rounded p-2">
                                <option value="">Select a location</option>
                                <option value="Bedroom">Bedroom</option>
                                <option value="Living Room">Living Room</option>
                                <option value="Bathroom">Bathroom</option>
                                <option value="Balcony">Balcony</option>
                                <option value="Kitchen">Kitchen</option>
                                <option value="Entry Way">Entry Way</option>
                                <option value="Sun Room">Sun Room</option>
                                <option value="Garden">Garden</option>
                                <option value="other">Other</option>
                            </select>
                            <button type="submit" class="bg-blue-500 text-white rounded p-2">Search</button>
                        </form>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @if($plantUsers->isEmpty())
                            <p class="text-gray-500">No plants found.</p>
                        @else
                            @foreach($plantUsers as $plant)
                                <div class="bg-white rounded-lg shadow-md p-4">
                                    <a href="{{ route('plantuser.show', $plant->id) }}">
                                        <x-plant-card  
                                            :name="$plant->name"
                                            :image="$plant->image"
                                        />
                                        <p><strong>Location:</strong> {{ $plant->location }}</p>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
