<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Explore Plants') }}
        </h2>
    </x-slot>

    <!-- alert success is a component that i created to display a success message that is sent by the controller to give feedback to the user-->
    <div class="py-12">
        <x-alert-success>
            {{session('success')}}
        </x-alert-success>

                    <!-- Display for Plants card components  -->
                    
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($plants as $plant)
                            <div class="bg-white rounded-lg shadow-md p-4 rounded-5 ">
                                <a href ="{{ route('plants.show',$plant) }}">
                                        <x-plant-card  
                                            :name="$plant->name"
                                            :image="$plant->image"
                                        />
                                        <a href="{{ route('plantuser.add', $plant->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add Plant</a>
                                </a>
                            </div>

                        @endforeach
        </div>
    </div>
</x-app-layout>

