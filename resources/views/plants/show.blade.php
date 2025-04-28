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
                    <a href="{{ route('plantuser.add', $plant) }}" >
                        <a href="{{ route('plantuser.add', $plant->id) }}" class="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="49" height="50" viewBox="0 0 39 40" fill="none">
                                            <rect width="39" height="40" rx="19.5" fill="#A4CAAB"/>
                                            <path d="M29 11V13C29 14.8565 28.2625 16.637 26.9497 17.9497C25.637 19.2625 23.8565 20 22 20H21V21H26V28C26 28.5304 25.7893 29.0391 25.4142 29.4142C25.0391 29.7893 24.5304 30 24 30H16C15.4696 30 14.9609 29.7893 14.5858 29.4142C14.2107 29.0391 14 28.5304 14 28V21H19V18C19 16.1435 19.7375 14.363 21.0503 13.0503C22.363 11.7375 24.1435 11 26 11H29ZM13.5 10C14.7 9.99903 15.8826 10.2864 16.9484 10.8379C18.0141 11.3894 18.9317 12.1888 19.624 13.169C18.5678 14.5578 17.9972 16.2552 18 18V19H17.5C15.5109 19 13.6032 18.2098 12.1967 16.8033C10.7902 15.3968 10 13.4891 10 11.5V10H13.5Z" fill="#5B7C61"/>
                                            </svg>
                                        </a>
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
                                    <p>{{ $note->note }}</p>
                                </div>

                                <!-- Edit and delete function for admins -->
                                <div class="flex justify-left gap-4">
                                    @if ($note->user_id === auth()->id() || auth()->user()?->role === 'admin')
                                        <a href="{{ route('notes.edit', $note) }}" 
                                            class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                            {{ __('Edit note') }}
                                        </a>

                                        <form method="POST" action="{{ route('notes.destroy', $note) }}" onsubmit="return confirm('Are you sure you want to delete this plant from garden?');">
                                            @csrf
                                            @method('delete')
                                            <a class="bg-red-700 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" href="{{ route('notes.destroy', $note) }}"
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
                                <textarea name="note" id="note" rows="4" class="mt-1 block w-full rounded-lg mb-3" placeholder="Write your Note here..."></textarea>
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
