<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Plants') }}
        </div>
    </x-slot>

    <div class="py-12">
        <x-alert-success>
            {{session('success')}}
        </x-alert-success>
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
                            
                            <h3 class="font-semibold text-lg mb-4">To do:</h3>
                            @isset($maintenance)
                            <div class="bg-white p-4 rounded-xl shadow mb-4">
                                <form method="POST" action="{{ route('maintenance.complete', $maintenance->id) }}" method="POST" onsubmit="return confirm('Mark this task as completed?');">
                                    @method('POST')
                                    @csrf
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" 
                                                id="complete-task-{{ $maintenance->task }}" 
                                                onchange="this.form.submit()" 
                                                class="w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500" />
                                        <label for="complete-task-{{ $maintenance->task }}" class="text-lg font-medium">
                                            {{ $maintenance->task }}
                                        </label>
                                    </div>
                                </form>
                            </div>
                            @endisset

                        <div class="py-12">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 text-gray-900">
                                        <h3 class="font-semibold text-lg mb-4">RECENT</h3>
                                            @foreach($maintenancelogs as $log)
                                                <p>{{ $maintenancelog->maintenance_id->task}} - Completed: {{ $log->completed_at->format('M d, Y') }}</p>
                                            @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        
    



</x-app-layout>
