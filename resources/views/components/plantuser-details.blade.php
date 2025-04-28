@props(['name', 'species', 'info', 'image','location'])

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


<div class="border rounded-lg shadow-md p-6 bg-white hover:shadow-lg transition duration-300 max-w-xl mx-auto"> <!-- Limit the overall container width to make the component more compact --> 

<!-- Plant Name --> 

<h1 class="font-bold text-black-600 mb-2 flex text-center justify-center" style="font-size: 3rem;">{{ $name }}</h1> <!-- Heading with larger text and color --> 


<!-- Plant Image --> 

<div class="overflow-hidden rounded-lg mb-4 flex justify-center"> 

<!-- Image is further restricted to a smaller size --> 

<img src="{{ asset('images/plants/' . $image) }}" alt="{{ $name }}"> <!-- Restrict image to max-w-xs (20rem) and ensure responsiveness --> 

</div> 

<div class="flex justify-center gap-4">
<!-- Species --> 

<h2 class="text-gray-500 text-sm italic mb-4 flex text-center justify-center" style="font-size: 1rem;">{{ $species }}</h2> <!-- Emphasizing year with italics and smaller text --> 

<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 25 25" fill="none">
<path d="M12.5 0L15.8761 9.12387L25 12.5L15.8761 15.8761L12.5 25L9.12387 15.8761L0 12.5L9.12387 9.12387L12.5 0Z" fill="black"/>
</svg>
<!-- Location--> 

<h2 class="text-gray-500 text-sm italic mb-4 flex text-center justify-center" style="font-size: 1rem;">{{ $location }}</h2> <!-- Emphasizing year with italics and smaller text --> 
</div>
<!-- Information --> 

<h3 class="text-gray-800 font-semibold mb-2 flex text-center justify-center" style="font-size: 2rem;">Information</h3> <!-- Subheading for description --> 
<p class="text-gray-700 leading-relaxed flex text-center justify-center">{{ $info }}</p> <!-- Text is spaced out for readability --> 

</div> 
