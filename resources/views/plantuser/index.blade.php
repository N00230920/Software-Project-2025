<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Plants') }}
        </h2>
    </x-slot>

    <!-- alert success is a component that i created to display a success message that is sent by the controller to give feedback to the user-->
    <div class="py-12">
        <x-alert-success>
            {{session('success')}}
        </x-alert-success>

                    <!-- Display for Plants card components  -->
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($plants as $plant)
                            <div class="bg-white rounded-lg shadow-md p-4">
                                <a href ="{{ route('plantuser.show',$plant) }}">
                                    <x-plant-card  
                                        :name="$plant->name"
                                        :image="$plant->image"
                                    />
                                </a>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
