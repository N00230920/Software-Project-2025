<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Plants') }}
        </div>
    </x-slot>

    <!-- Plant Card -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">Plant Details</h3>
                    <x-plantuser-details 
                        :name="$plantUser->name"
                        :image="$plantUser->image"
                        :species="$plant->species"
                        :info="$plant->info"
                        :location="$plantUser->location" 
                    />

                    <!-- Edit and Delete Buttons -->
                    <div class="flex space-x-2">
                        <!-- Edit button route to plants.edit, and receives the $plant object to know which plant to edit -->
                        <a href="{{ route('plantuser.edit', $plantUser->id) }}" 
                            class="text-gray-600 hover:bg-orange-300 hover:bg-orange-700 font-bold py-2 px-4 rounded">
                            Edit
                        </a>

                        <!-- Delete button (you need a form to send DELETE requests) -->
                        <!-- Delete button route to plants.destroy, passing $plant object -->
                        <form action="{{ route('plantuser.destroy', $plantUser->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this plant from garden?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit" 
                                class="bg-red-500 hover:bg-red-700 text-gray-600 font-bold py-2 px-4 rounded">
                                Delete
                            </button>
                        </form>
                    </div>   
                    
                    <!-- Maintenance -->
            <div class="p-1">
                <div class="max-w-7xl">
                    <div class="bg-green-200 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="font-semibold text-lg mb-4 ">Maintenance</h3>
                            <div class="bg-white p-12 mb-4 rounded-lg">
                            <div class="flex flex-row gap-2 justify-between">
                                <div class="text-center p-5 border-2 border-black">
                                    <h2>Watering</h2>
                                    <p>Water your plant every 2-3 days</p>
                                </div>
                                <div class="text-center p-5 border-2 border-black">
                                    <h2>Watering</h2>
                                    <p>Water your plant every 2-3 days</p>
                                </div>

                                <div class="text-center p-5 border-2 border-black">
                                    <h2>Watering</h2>
                                    <p>Water your plant every 2-3 days</p>
                                </div>

                            </div>
                        </div>

                        <h3 class="font-semibold text-lg mb-4 ">To do:</h3>
                        <div class="form-check">
                            <label class="form-check-label" for="flexCheckDefault">
                                Default checkbox
                            </label>
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            </div>

                            <div class="form-check">

                            <label class="form-check-label" for="flexCheckChecked">
                                Checked checkbox
                            </label>
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>

                        </div>

                        <div class="py-12">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 text-gray-900">
                                        <h3 class="font-semibold text-lg mb-4">RECENT</h3>
                                        <p>Watered - 2 days ago</p>
                                    </div>
                                </div>
                            </div>
                        </div>

            

</x-app-layout>
