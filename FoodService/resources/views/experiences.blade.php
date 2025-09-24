<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Cooking Classes</title>
</head>
<body>
    @extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Private Cooking Classes & Experiences</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ($experiences as $exp)
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-xl font-bold">{{ $exp->title }}</h2>
                <p class="text-sm text-gray-600 mb-2">Category: {{ $exp->category->name ?? 'N/A' }}</p>
                <p class="mb-4">{{ Str::limit($exp->description, 100) }}</p>
                <a href="{{ route('experience.show', $exp->id) }}" class="text-blue-600 hover:underline">View Details</a>
            </div>
        @endforeach
    </div>
@endsection

</body>
</html>