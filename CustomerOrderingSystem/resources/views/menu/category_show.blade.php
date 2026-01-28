<!DOCTYPE html>
<html>
<head>
    <title>{{ $category->name }} - Caffè Sant’Antonio</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #F0F0F0; }
        .top-bar { background-color: #C4FFB6; padding: 10px 20px; display: flex; justify-content: space-between; align-items: center; }
        .logo-container { display: flex; align-items: center; font-size: 1.5em; font-weight: bold; color: #333; }
        .logo-container img { width: 40px; margin-right: 10px; }
        .return-button { background-color: #5CB85C; color: white; text-decoration: none; padding: 10px 18px; border-radius: 25px; font-weight: bold; }
        .menu-grid { max-width: 900px; margin: 50px auto; display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; padding: 20px; }
        .menu-item { background-color: white; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-align: center; cursor: pointer; overflow:hidden; }
        .menu-item-image { width: 100%; height: 150px; background-color: #D3D3D3; display:flex; justify-content:center; align-items:center; }
        .menu-item-image img { width: 100%; height: 100%; object-fit: cover; display:block; }
        .menu-item-button { background-color: #5CB85C; color: white; padding: 15px 10px; font-weight: bold; }
    </style>
</head>
<body>

<div class="top-bar">
    <div class="logo-container">
        <img src="{{ asset('images/cafelogowbg.png') }}" alt="Logo">
        {{ $category->name }}
    </div>
    <div>
        <a href="{{ route('menu.index') }}" class="return-button">Back to Menu</a>
        <a href="{{ url('/home') }}" class="return-button">Homepage</a>
    </div>
</div>

<h2 style="text-align:center; margin-top:20px;">Subcategories</h2>

<div class="menu-grid">
    @if($subcategories && $subcategories->count() > 0)
        @foreach($subcategories as $subcategory)
            @php
                // Normalize subcategory name for image filename
                $normalizedName = strtolower(str_replace(' ', '', $subcategory->name));
                $extensions = ['jpg','jpeg','png','gif'];
                $imageFile = 'images/placeholder.png'; // default fallback

                // Check if a matching image exists in public/images/
                foreach ($extensions as $ext) {
                    $filePath = public_path('images/' . $normalizedName . '.' . $ext);
                    if (file_exists($filePath)) {
                        $imageFile = 'images/' . $normalizedName . '.' . $ext;
                        break;
                    }
                }
            @endphp

            <a href="{{ route('menu.subcategory.show', $subcategory->id) }}" class="menu-item">
                <div class="menu-item-image">
                    <img src="{{ asset($imageFile) }}" alt="{{ $subcategory->name }}">
                </div>
                <div class="menu-item-button">{{ $subcategory->name }}</div>
            </a>
        @endforeach
    @else
        <p style="grid-column: span 3; text-align:center;">No subcategories found.</p>
    @endif
</div>

</body>
</html>
