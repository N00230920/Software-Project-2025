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

                name="title"
        id="name"
        value="{{ old('title', $plant->title ?? '') }}"
        required
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        @error('title')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Genre dropdown -->
    <div class="mb-4">
            <label for="genre" class="block text-sm text-gray-700">Location</label>
            <select id="genre" class="rounded mb-2" name="genre">
                <option value="">Select a genre</option> 
                <option value="action">action</option>
                <option value="adventure">adventure</option>
                <option value="adult animation">adult animation</option>
                <option value="anime">anime</option>
                <option value="crime">crime</option>
                <option value="fantasy">fantasy</option>
                <option value="historical">historical</option>
                <option value="horror">horror</option>
                <option value="romance">romance</option>
                <option value="sci-fi">sci-fi</option>
            </select>
        @error('genre')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Image upload field -->
    <div class="mb-4">
        <label for="image" class="block text-sm font-medium text-gray-700">plant Cover Image</label>
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