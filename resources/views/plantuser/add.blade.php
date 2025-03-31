<x-app-layout>

<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add plants to your garden') }}
        </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="font-semibold text-lg mb-4">Add {{ $plant->name }} to Your Collection</h2>

                

                    @csrf
                <x-plant-form 
                    :action="route('plantuser.store', $plant->id)"

                    :method="'POST'"
                    enctype="multipart/form-data"
                />
                <!-- Removed unnecessary fields -->

                @if ($errors->any())
                <div class="alert alert-danger" role="alert">

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
</x-app-layout>
