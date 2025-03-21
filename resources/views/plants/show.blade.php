<app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Explore Plants') }}
        </div>
    </x-slot>

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
                                    <p>⭐ Task: {{ $note->task }} / 5</p>
                                    <p>{{ $note->note }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Add a Note -->
                    <h4 class="font-semibold text-md mt-8">Add a Note</h4>
                    <form action="{{ route('notes.store', $plant) }}" method="POST" class="mt-4">
                        @csrf
                        <div class="grid gap-4">
                            <div class="rating">
                                <label for="rating" class="block font-medium text-sm text-gray-700">Rating</label>
                                <select id="rating" name="rating" class="mt-1 block w-full" required>
                                    <option value="1">⭐ 1</option>
                                    <option value="2">⭐⭐ 2</option>
                                    <option value="3">⭐⭐⭐ 3</option>
                                    <option value="4">⭐⭐⭐⭐ 4</option>
                                    <option value="5">⭐⭐⭐⭐⭐ 5</option>
                                </select>
                            </div>

                            <div class="note">
                                <label for="note" class="block font-medium text-sm text-gray-700">Note</label>
                                <textarea name="note" id="note" rows="4" class="mt-1 block w-full" placeholder="Write your Note here..."></textarea>
                            </div>
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Submit Note
                        </button>

                        @if ($errors->any())
                            <div class="mt-2 text-red-600">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</app-layout>
