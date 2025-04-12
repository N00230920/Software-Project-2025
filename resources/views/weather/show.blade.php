<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-green-50 to-green-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
        <div class="p-8">
            <!-- Title and Search Form -->
            <div class="mb-8 text-center">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Weather Forecast</h1>
                <p class="text-gray-600">Get current weather information for any city</p>
                
                <form method="GET" action="{{ route('weather.show') }}" class="mt-6">
                    <div class="flex rounded-md shadow-sm">
                        <input 
                            type="text" 
                            name="city" 
                            class="flex-1 min-w-0 block w-full px-3 py-3 rounded-l-md border-gray-300 focus:ring-green-500 focus:border-green-500 text-gray-700 border" 
                            placeholder="Enter city name" 
                            value="{{ $city }}"
                        >
                        <button 
                            type="submit" 
                            class="inline-flex items-center px-4 py-3 border border-transparent text-sm font-medium rounded-r-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                        >
                            Search
                        </button>
                    </div>
                </form>
            </div>

            @if(isset($weather))
                <!-- Weather Card -->
                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-lg overflow-hidden text-white">
                    <div class="p-6">
                        <!-- Location and Date -->
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h2 class="text-2xl font-bold">{{ $weather['name'] }}, {{ $weather['sys']['country'] }}</h2>
                                <p class="text-green-100">{{ now()->format('l, F j, Y') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-green-200 capitalize">{{ $weather['weather'][0]['description'] }}</p>
                            </div>
                        </div>

                        <!-- Main Weather Info -->
                        <div class="flex items-center justify-between mb-8">
                            <div class="flex items-center">
                                <img 
                                    src="https://openweathermap.org/img/wn/{{ $weather['weather'][0]['icon'] }}@4x.png" 
                                    alt="Weather icon" 
                                    class="w-24 h-24 mr-4"
                                >
                                <div>
                                    <span class="text-5xl font-bold">{{ round($weather['main']['temp']) }}°C</span>
                                    <span class="block text-green-200">Feels like {{ round($weather['main']['feels_like']) }}°C</span>
                                </div>
                            </div>
                        </div>

                        <!-- Weather Details -->
                        <div class="grid grid-cols-2 gap-4 text-center">
                            <div class="bg-green-400 bg-opacity-30 rounded-lg p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                </svg>
                                <p class="text-sm text-green-100">Humidity</p>
                                <p class="text-xl font-semibold">{{ $weather['main']['humidity'] }}%</p>
                            </div>
                            
                            <div class="bg-green-400 bg-opacity-30 rounded-lg p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                <p class="text-sm text-green-100">Wind</p>
                                <p class="text-xl font-semibold">{{ $weather['wind']['speed'] }} m/s</p>
                            </div>
                            
                            <div class="bg-green-400 bg-opacity-30 rounded-lg p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                </svg>
                                <p class="text-sm text-green-100">Pressure</p>
                                <p class="text-xl font-semibold">{{ $weather['main']['pressure'] }} hPa</p>
                            </div>
                            
                            <div class="bg-green-400 bg-opacity-30 rounded-lg p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                </svg>
                                <p class="text-sm text-green-100">Visibility</p>
                                <p class="text-xl font-semibold">{{ isset($weather['visibility']) ? round($weather['visibility']/1000, 1).' km' : 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
</x-app-layout>