@props(['action', 'method', 'plant', 'plantUser'])

<form action="{{ route('plantuser.update', $plantUser) }}" method="POST" enctype="multipart/form-data">


    @csrf
    @if($method === 'PUT' || $method === 'PATCH')
        @method($method)
    @endif

    <div class="sm:mb-4">
        <label for="plantuser" class="block text-sm font-medium text-gray-700">Name</label>
            <input
                type="text"
                name="name"
            id="plantuser"
            value="{{ old('plantuser', $plantUser->name ?? '') }}"
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
        />
        @error('plantuser')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Location Dropdown -->
    <div class="sm:mb-4">
        <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
        <select 
            name="location" 
            id="location" 
            value="{{ old('plantuser', $plantUser->location ?? '') }}"
            required 
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
        >
            <option value="">Select a location</option> 
                <option value="Bedroom" {{ old('location', $plantUser->location ?? '') == 'Bedroom' ? 'selected' : '' }}>Bedroom</option>
                <option value="Living Room" {{ old('location', $plantUser->location ?? '') == 'Living Room' ? 'selected' : '' }}>Living Room</option>
                <option value="Bathroom"{{ old('location', $plantUser->location ?? '') == 'Bathroom' ? 'selected' : '' }}>Bathroom</option>
                <option value="Balcony"{{ old('location', $plantUser->location ?? '') == 'Balcony' ? 'selected' : '' }}>Balcony</option>
                <option value="Kitchen"{{ old('location', $plantUser->location ?? '') == 'Kitchen' ? 'selected' : '' }}>Kitchen</option>
                <option value="Entry Way"{{ old('location', $plantUser->location ?? '') == 'Entry Way' ? 'selected' : '' }}>Entry Way</option>
                <option value="Sun Room"{{ old('location', $plantUser->location ?? '') == 'Sun Room' ? 'selected' : '' }}>Sun Room</option>
                <option value="Garden"{{ old('location', $plantUser->location ?? '') == 'Garden' ? 'selected' : '' }}>Garden</option>
                <option value="other">other</option>
        </select>
        @error('location')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Image Upload -->
    <div class="sm:mb-4">
        <label for="image" class="block text-sm font-medium text-gray-700">Upload Image</label>
        <input 
            type="file" 
            name="image" 
            id="image" 
            accept="image/*" 
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
        />
        @error('image')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror

        <!-- Show existing image if available -->
        @if(isset($plantUser->image))
            <div class="mt-2">
                <p class="text-sm text-gray-600">Current Image:</p>
                <img src="{{ asset('images/plants/' . $plantUser->image) }}" alt="Plant Image" class="w-32 h-32 object-cover rounded-md">
            </div>
        @endif
    </div>


    <x-primary-button>
        {{ isset($plantUser) ? 'Update Plant' : 'Save Plant' }}
    </x-primary-button>

    {{-- Cancel button (Uncomment if you need it) --}}
    {{-- <button type="button" onclick="window.location='{{ route('plantuser.show', $plantUser->id) }}'"
        class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md ml-2">
        Cancel
    </button> --}}
</form>
