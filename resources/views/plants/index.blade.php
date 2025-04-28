<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Explore Plants') }}
        </h2>
    </x-slot>
    
        @auth
                @foreach(auth()->user()->unreadNotifications as $notification)
                    <x-alert-success class="py-12">
                        {{ $notification->data['message'] }}
                    </x-alert-success>
                    @php
                        $notification->markAsRead();
                    @endphp
                @endforeach
        @endauth

    <!-- alert success is a component that i created to display a success message that is sent by the controller to give feedback to the user-->
    <div class="py-12">
        <x-alert-success>
            {{session('success')}}
        </x-alert-success>

                    <!-- Display for Plants card components  -->
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($plants as $plant)
                            <div class="bg-white rounded-lg shadow-md p-4 rounded-5 ">
                                <a href ="{{ route('plants.show',$plant) }}">
                                        <x-plant-card  
                                            :name="$plant->name"
                                            :image="$plant->image"
                                        />
                                        <a href="{{ route('plantuser.add', $plant->id) }}" class="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="49" height="50" viewBox="0 0 39 40" fill="none">
                                            <rect width="39" height="40" rx="19.5" fill="#A4CAAB"/>
                                            <path d="M29 11V13C29 14.8565 28.2625 16.637 26.9497 17.9497C25.637 19.2625 23.8565 20 22 20H21V21H26V28C26 28.5304 25.7893 29.0391 25.4142 29.4142C25.0391 29.7893 24.5304 30 24 30H16C15.4696 30 14.9609 29.7893 14.5858 29.4142C14.2107 29.0391 14 28.5304 14 28V21H19V18C19 16.1435 19.7375 14.363 21.0503 13.0503C22.363 11.7375 24.1435 11 26 11H29ZM13.5 10C14.7 9.99903 15.8826 10.2864 16.9484 10.8379C18.0141 11.3894 18.9317 12.1888 19.624 13.169C18.5678 14.5578 17.9972 16.2552 18 18V19H17.5C15.5109 19 13.6032 18.2098 12.1967 16.8033C10.7902 15.3968 10 13.4891 10 11.5V10H13.5Z" fill="#5B7C61"/>
                                            </svg>
                                        </a>
                                </a>
                            </div>

                        @endforeach
        </div>
    </div>
</x-app-layout>

