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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">Plant Details</h3>
                    <x-plantuser-details 
                        :name="$plantUser->name"
                        :image="$plantUser->image"
                        :species="$plant?->species"
                        :info="$plant?->info"
                        :location="$plantUser->location" 
                    />                    
                    
                    <!-- Maintenance Section -->
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- To Do Section -->
                        <div class="bg-green-100 p-6 rounded-lg shadow">
                            <h3 class="font-semibold text-lg mb-4 text-gray-800">To Do:</h3>
                            @if($incompleteLogs->count() > 0)
                            @foreach($plantUser->maintenances()->wherePivotNull('completed_at')->get() as $task)
                                <div class="bg-white p-3 rounded mb-2 flex items-center">
                                    <form method="POST" action="{{ route('maintenance.complete', [$plantUser->id, $task->id]) }}">
                                        @csrf
                                        <input type="checkbox" 
                                            onchange="this.form.submit()"
                                            class="mr-2 h-5 w-5 text-green-600">
                                        <span>{{ $task->task }} ({{ $task->frequency }})</span>
                                    </form>
                                </div>
                            @endforeach
                            @else
                                <p class="text-gray-500">All caught up! No tasks to do.</p>
                            @endif
                            <form action="{{ route('plantuser.assign-tasks', $plantUser->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                                Assign Maintenance Tasks
                            </button>
                        </form>
                        </div>

                        <!-- Recent Completions Section -->
                        <div class="bg-blue-50 p-6 rounded-lg shadow">
                            <h3 class="font-semibold text-lg mb-4 text-gray-800">Recent Maintenance</h3>
                            @if($completedLogs->count() > 0)
                                <div class="space-y-3">
                                    @foreach($completedLogs as $maintenance)
                                        <div class="bg-white p-4 rounded-lg shadow">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <p class="text-gray-800 font-medium">
                                                        {{ $maintenance->task }}
                                                    </p>
                                                    <p class="text-sm text-gray-500 mt-1">
                                                    Completed: {{ $maintenance->pivot->completed_at ? \Carbon\Carbon::parse($maintenance->pivot->completed_at)->format('M d, Y h:i A') : 'Not completed' }}
                                                    </p>
                                                </div>
                                                <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded-full">
                                                    Done
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500">No recent maintenance records.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Edit and Delete Buttons -->
                    <div class="flex space-x-2 mt-4">
                        <a href="{{ route('plantuser.edit', $plantUser->id) }}" 
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Edit
                        </a>

                        <form action="{{ route('plantuser.destroy', $plantUser->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this plant from garden?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                            class="bg-red-700 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                Delete
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        
    </div>
</x-app-layout>