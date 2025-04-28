@props(['name', 'image'])
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    
    <style>
        h1 {
            font-family: 'Crimson Text', sans-serif;
        }
        p {
            font-family: 'Nunito Sans', sans-serif;
        }
    </style>

<div class="border rounded-lg shadow-md p-6 bg-white hover:shadow-lg transition duration-300">
    <h1 class="font-semibold text-3xl flex items-center justify-center">{{ $name }}</h1>
<img class="rounded-lg" src="{{ asset('images/plants/' . $image) }}" alt="{{ $name }}">


</div>
