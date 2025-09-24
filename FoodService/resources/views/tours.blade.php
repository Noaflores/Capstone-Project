<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Food Tutorials</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-yellow-50 via-pink-100 to-red-100 min-h-screen font-sans text-gray-800">

<div class="container mx-auto px-4 py-10">
  

  <div class="flex flex-col md:flex-row justify-between items-center mb-10">
    <h1 class="text-4xl font-extrabold text-red-600 mb-4 md:mb-0">🍱 Choose a Food Tutorial</h1>
    <a href="{{ route('home') }}" class="inline-block bg-white border border-gray-400 text-gray-700 px-5 py-2 rounded-full hover:bg-gray-100 transition">
      ← Back to Home
    </a>
  </div>


  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
    @php
    $tours = [
      [
        'title' => 'Meat Tutorial',
        'slug' => 'meat',
        'price' => '₱250',
        'img' => 'https://metro.co.uk/wp-content/uploads/2018/11/sei_38669555-3278.jpg?quality=90&strip=all&w=646',
        'source' => 'https://www.nationalhogfarmer.com/market-news/study-shows-eating-meat-extends-human-life-expectancy-worldwide'
      ],
      [
        'title' => 'Vegetable Tutorial',
        'slug' => 'vegetable',
        'price' => '₱200',
        'img' => 'https://domf5oio6qrcr.cloudfront.net/medialibrary/11499/3b360279-8b43-40f3-9b11-604749128187.jpg',
        'source' => 'https://www.britannica.com/topic/vegetable'
      ],
      [
        'title' => 'Juice Tutorial',
        'slug' => 'juice',
        'price' => '₱150',
        'img' => 'https://assets.clevelandclinic.org/transform/LargeFeatureImage/47cdb246-3c9d-4efb-8b3b-1e6b85567a16/Fruit-Juice-155376375-770x533-1_jpg',
        'source' => 'https://refreshjuice.com.au/blogs/news/10-health-benefits-of-drinking-fresh-juice-every-day'
      ],
      [
        'title' => 'Shake Tutorial',
        'slug' => 'shake',
        'price' => '₱150',
        'img' => 'https://static.toiimg.com/thumb/imgsize-23456,msid-113025195,width-600,resizemode-4/113025195.jpg',
        'source' => 'https://timesofindia.indiatimes.com/life-style/food-news/7-fruit-shakes-for-meal-replacement/articleshow/113025195.cms'
      ],
    ];
    @endphp

    @foreach($tours as $tour)
    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transform hover:scale-105 transition duration-300 overflow-hidden">
      <a href="{{ $tour['source'] }}" target="_blank">
        <img src="{{ $tour['img'] }}" alt="{{ $tour['title'] }}" class="w-full h-48 object-cover">
      </a>
      <div class="p-5 text-center">
        <h3 class="text-lg font-semibold mb-2 text-gray-800">{{ $tour['title'] }}</h3>
        <p class="text-sm text-gray-600 mb-4">{{ $tour['price'] }}</p>
        <a href="{{ route('book', ['topic' => $tour['slug']]) }}" class="inline-block bg-red-500 hover:bg-red-600 text-white font-medium px-4 py-2 rounded-full transition">
          Book Now
        </a>
      </div>
    </div>
    @endforeach

  </div>
</div>

</body>
</html>
