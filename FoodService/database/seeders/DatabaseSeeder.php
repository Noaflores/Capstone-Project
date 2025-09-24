<?php

namespace Database\Seeders;

use App\Models\ChefUser;
use App\Models\Category;
use App\Models\Experience;
use App\Models\Booking;
use App\Models\Review;
use App\Models\EventSchedule;
use App\Models\Payment;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    Category::factory(4)->create();

    Experience::factory(4)->create();

    EventSchedule::factory(3)->create();

    Booking::factory(3)->create();

    Payment::factory(3)->create();

    Review::factory(3)->create();

    $this->call(ReviewSeeder::class);

    ChefUser::factory()->personalChef('Drinks teaching')->create([
    'name' => 'Noah Flores',
    'email' => 'noah.flores@example.com',
]);

    ChefUser::factory()->cookingTeacher('Meat teaching')->create([
    'name' => 'Marco Ollero',
    'email' => 'marco.ollero@example.com',
]);

    ChefUser::factory()->personalChef('Vegetable teaching')->create([
    'name' => 'Robbie Manimtim',
    'email' => 'robbie.manimtim@example.com',
]);

    ChefUser::factory()->shakeTeacher('Shake teaching')->create([
    'name' => 'Irish Cabingue',
    'email' => 'irish.cabingue@example.com',
]);

ChefUser::where('name', 'Irish Cabingue')->update([
    'chef_title' => 'Chill Composer',
    'favorite_dish' => 'Fried Chicken',
    'quote' => 'Shake it til you make it!',
    'teaching_years' => 8
]);

ChefUser::where('name', 'Marco Ollero')->update([
    'chef_title' => 'Passionate Griller',
    'favorite_dish' => 'Adobo',
    'quote' => 'Every great meal begins with a great sauce.',
    'teaching_years' => 6
]);

ChefUser::where('name', 'Robbie Manimtim')->update([
    'chef_title' => 'The Organic Scaler',
    'favorite_dish' => 'Spaghetti',
    'quote' => 'Nourish your body with natures bounty.',
    'teaching_years' => 9
]);

ChefUser::where('name', 'Noah Flores')->update([
    'chef_title' => 'The Juice Bearer',
    'favorite_dish' => 'Sisig',
    'quote' => 'I only drink a little, but when I do I turn into another person and that person drinks a lot!',
    'teaching_years' => 7
]);

}

}