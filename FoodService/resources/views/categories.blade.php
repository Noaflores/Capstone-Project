<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
</head>
<body>
    @extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Food & Drink Categories</h1>
    <ul class="list-disc list-inside">
        @foreach ($categories as $category)
            <li>{{ $category->name }}</li>
        @endforeach
    </ul>
@endsection

</body>
</html>