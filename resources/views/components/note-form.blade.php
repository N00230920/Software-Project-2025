@props(['action', 'method', 'plant', 'note'])

<form action="{{ route('notes.update', $note) }}" method="POST" enctype="multipart/form-data">


    @csrf
    @if($method === 'PUT' || $method === 'PATCH')
        @method($method)
    @endif

    <div class="sm:mb-4">
        <label for="note" class="block text-sm font-medium text-gray-700">Notes</label>
        <input
            type="text"
            name="note"
            id="note"
            value="{{ old('note', $note->note ?? '') }}"
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
        />
        @error('note')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>


    <x-primary-button>
        {{ isset($note) ? 'Update note' : 'Save note' }}
    </x-primary-button>

    {{-- Cancel button (Uncomment if you need it) --}}
    {{-- <button type="button" onclick="window.location='{{ route('plants.show', $plant->id) }}'"
        class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md ml-2">
        Cancel
    </button> --}}
</form>
