<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                <div class= "mb-2 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="44" height="32" viewBox="0 0 44 32" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M22.0011 7.46892C18.1051 3.51594 13.2359 1.86128 9.42977 1.18423C7.84746 0.900319 6.24517 0.745992 4.63842 0.722747C4.03117 0.714524 3.42383 0.729715 2.81771 0.768288L2.70691 0.777396H2.67696L2.66499 0.780433H2.659L1.52105 0.889732L1.3264 2.0313L1.32341 2.04648L1.31742 2.08291L1.29346 2.21954L1.22459 2.71442C0.901282 5.26407 0.817057 7.83905 0.97304 10.4048C1.26651 14.9923 2.49429 20.8307 6.49507 24.8869C10.406 28.8521 15.1734 30.3974 18.8927 30.9621C20.5028 31.2071 22.1316 31.3036 23.7589 31.2506V28.7306L12.2207 17.0265L14.3409 14.877L23.7619 24.4346V9.65794C23.2468 8.86856 22.6599 8.13686 22.0011 7.46892ZM26.7565 13.8295V24.9416L31.8114 20.8429L33.68 23.211L26.7565 28.8278V31.2202C27.8515 31.2334 28.9461 31.1706 30.0326 31.032C32.7547 30.6767 36.2913 29.69 38.9205 27.0243C41.5737 24.3313 42.5949 20.266 42.9992 17.1297C43.2373 15.2394 43.3155 13.3318 43.2327 11.428L43.2268 11.3308V11.3005L43.2238 11.2944L43.1339 10.0708L41.9421 9.89779H41.9301L41.9031 9.89172L41.8133 9.87958L41.4809 9.84011C39.8073 9.66839 38.1223 9.63995 36.444 9.7551C33.5183 9.97369 29.6613 10.76 27.1757 13.3863L27.056 13.5077L26.7565 13.8295Z" fill="green"/>
        </svg>
    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
