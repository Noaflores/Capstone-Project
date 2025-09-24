<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Food Service Project</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">

<header class="bg-white shadow p-4 mb-8">
    <nav class="container mx-auto flex space-x-6">
        <a href="{{ route('home') }}" class="hover:underline"><button>Home</button></a>
        <a href="{{ route('tours') }}" class="hover:underline"><button>Food Tours</button></a>
        <a href="{{ route('cooking-classes.index') }}" class="hover:underline"><button>Cooking Classes</button></a>
        <a href="{{ route('chefs.index') }}" class="hover:underline"><button>Chefs</button></a>
        <a href="{{ route('reviews.index') }}" class="hover:underline"><button>Reviews</button></a>
    </nav>
</header>

<main class="container mx-auto px-4">
    @yield('content')
</main>

</body>
</html>
