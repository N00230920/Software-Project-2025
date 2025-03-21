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
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($plants as $plant)
                            <div class="bg-white rounded-lg shadow-md p-4">
                                <a href ="{{ route('plants.show',$plant) }}">
                                        <x-plant-card
                                            :name="$plant->name"
                                            :image="$plant->image"
                                        />
                                        
                                </a>
                                
                                <!-- Edit and Delete Buttons -->
                                <div class="flex space-x-2">
                                    <!-- Edit button route to plants.edit, and receives the $plant object to know which plant to edit -->
                                    <a href="{{ route('plants.edit', $plant) }}" 
                                        class="text-gray-600 hover:bg-orange-300 hover:bg-orange-700 font-bold py-2 px-4 rounded">
                                        Edit
                                    </a>

                                    <!-- Delete button (you need a form to send DELETE requests) -->
                                    <!-- Delete button route to plants.destroy, passing $plant object -->
                                    <form action="{{ route('plants.destroy', $plant) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this plant from garden?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" 
                                            class="bg-red-500 hover:bg-red-700 text-gray-600 font-bold py-2 px-4 rounded">
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </div>

                        @endforeach
            
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

