<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Explore Plants') }}
        </div>
    </x-slot>

    <!-- Plant Card -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">Plant Details</h3>
                    <x-plant-details 
                        :name="$plant->name"
                        :image="$plant->image"
                        :species="$plant->species"
                        :info="$plant->info" 
                    />

                    <!-- Add button -->
                    @if(auth()->check() && auth()->user()->role === 'admin')
                    <a href="{{ route('plantuser.add', $plant) }}" 
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Add to your garden
                    </a>
                    @endif

                    <!-- Plant Notes -->
                    <h4 class="font-semibold text-md mt-8">Notes</h4>
                    @if ($plant->notes->isEmpty())
                        <p class="text-gray-600">No notes yet.</p>
                    @else
                        <div class="mt-4 space-y-4">
                            @foreach ($plant->notes as $note)
                            <div class="bg-gray-100 p-4 rounded-lg">
                                <div class="bg-gray-100 p-4 rounded-lg">
                                    <p class="font-semibold">{{ $note->user->name }} | {{ $note->created_at->format('M d, Y') }}</p>
                                    <p>Task: {{ $note->task }} / 5</p>
                                    <p>{{ $note->note }}</p>
                                </div>

                                <!-- Edit and delete function for admins -->
                                    @if ($note->user_id === auth()->id() || auth()->user()?->role === 'admin')
                                        <a href="{{ route('notes.edit', $note) }}" 
                                            class="bg-yellow-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
                                            {{ __('Edit note') }}
                                        </a>

                                        <form method="POST" action="{{ route('notes.destroy', $note) }}" onsubmit="return confirm('Are you sure you want to delete this plant from garden?');">
                                            @csrf
                                            @method('delete')
                                            <a class="bg-red-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded" href="{{ route('notes.destroy', $note) }}"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Delete note') }}
                                            </a>
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Add a Note -->
                    <h4 class="font-semibold text-md mt-8">Add a Note</h4>
                    <form action="{{ route('notes.store', ['plant' => $plant->id]) }}" method="POST" class="mt-4">
                    @csrf

                            <div class="note">
                                <label for="note" class="block font-medium text-sm text-gray-700">Note</label>
                                <textarea name="note" id="note" rows="4" class="mt-1 block w-full" placeholder="Write your Note here..."></textarea>
                            </div>
                        

                        <div>
                        <x-primary-button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Submit Note
                        </x-primary-button>

                        @if ($errors->any())
                            <div class="mt-2 text-red-600">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        </div>
                    </form>
</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
