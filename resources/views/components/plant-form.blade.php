@props(['action', 'method', 'plant'])
<!-- Define properties for the form: action URL, HTTP method, and plant data -->

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($method === 'PUT' || $method === 'PATCH')
        @method($method)
    @endif
    

    <!-- Name input field -->
        <div class="mb-4">
            <label for="title" class="block text-sm text-gray-700">Name</label>
            <input
                type="text"

                name="name"
        id="name"
        value="{{ old('name', $plant->name ?? '') }}"
        required
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        @error('name')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Information -->
    <div class="mb-4">
            <label for="title" class="block text-sm text-gray-700">Information</label>
            <input
                type="text"
                name="info"
        id="info"
        value="{{ old('info', $plant->info ?? '') }}"
        required
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        @error('info')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Species -->
    <div class="mb-4">
            <label for="title" class="block text-sm text-gray-700">Species</label>
            <input
                type="text"
                name="species"
        id="species"
        value="{{ old('species', $plant->species ?? '') }}"
        required
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        @error('species')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- location dropdown -->
    <div class="mb-4">
            <label for="location" class="block text-sm text-gray-700">Location</label>
            <select id="location" class="rounded mb-2" name="location">
                <option value="">Select a location</option> 
                <option value="Bedroom">Bedroom</option>
                <option value="Living Room">Living Room</option>
                <option value="Bathroom">Bathroom</option>
                <option value="Balcony">Balcony</option>
                <option value="Kitchen">Kitchen</option>
                <option value="Entry Way">Entry Way</option>
                <option value="Sun Room">Sun Room</option>
                <option value="Garden">Garden</option>
                <option value="other">other</option>
            </select>
        @error('location')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Image upload field -->
    <div class="mb-4">
        <label for="image" class="block text-sm font-medium text-gray-700">Plant Cover Image</label>
        <input
            type="file"
            name="image"
            id="image"
            {{ isset($plant) ? '' : 'required' }}
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
        @error('image')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    @isset($plant->image)
        <div class="mb-4">
            <img src="{{ asset($plant->image) }}" alt="plant cover" class="w-24 h-32 object-cover" />
        </div>
    @endisset
<div>
    <x-primary-button>
        {{ isset($plant) ? 'Update plant' : 'Add plant' }}
    </x-primary-button>
</div>
</form>