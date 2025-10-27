<?php

//namespace Database\Seeders;

//use Illuminate\Database\Seeder;
// Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Schema;
//use App\Models\User;
//use App\Models\Order;
//use App\Models\MenuItem;

//class OrderItemsTableSeeder extends Seeder
//{
    //public function run(): void
    //{
        // Ensure at least one user exists
        //$user = User::first() ?: User::create([
            //'name' => 'Staff',
            //'email' => 'staff@example.com',
            //'password' => bcrypt('password123'),
            //'role' => 'staff',
        //]);

        // Ensure menu items exist
        //$coffee = MenuItem::firstOrCreate(
            //['name' => 'Coffee'],
            //['item_id' => 'IID1001', 'price' => 210.00, 'description' => 'Hot brewed coffee']
       // );

       // $pizza = MenuItem::firstOrCreate(
            //['name' => 'Pizza'],
            //['item_id' => 'IID1002', 'price' => 450.00, 'description' => 'Cheesy oven-baked pizza']
        //);

        //$pasta = MenuItem::firstOrCreate(
            //['name' => 'Pasta'],
            //['item_id' => 'IID1003', 'price' => 200.00, 'description' => 'Delicious pasta']
        //);

        //$sandwich = MenuItem::firstOrCreate(
            //['name' => 'Sandwich'],
            //['item_id' => 'IID1004', 'price' => 150.00, 'description' => 'Freshly made sandwich']
        //);

        //$fries = MenuItem::firstOrCreate(
            //['name' => 'Fries'],
            //['item_id' => 'IID1005', 'price' => 100.00, 'description' => 'Crispy golden fries']
        //);

        //$steak = MenuItem::firstOrCreate(
            //['name' => 'Steak'],
            //['item_id' => 'IID1006', 'price' => 700.00, 'description' => 'Juicy grilled steak']
        //);

        //$salad = MenuItem::firstOrCreate(
            //['name' => 'Salad'],
            //['item_id' => 'IID1007', 'price' => 200.00, 'description' => 'Healthy fresh salad']
        //);

        // Get all orders
        //$orders = Order::all();
        //if ($orders->count() < 3) {
            //$this->command->warn(' Make sure OrdersTableSeeder has run first!');
            //return;
        //}

        //$order1 = $orders[0];
        //$order2 = $orders[1];
        //$order3 = $orders[2];

        // Detect which FK column is used
        //$fkColumn = Schema::hasColumn('order_items', 'menu_item_id') ? 'menu_item_id' : 'item_id';

        // --- ORDER 1: Coffee, Pizza, Pasta ---
        //DB::table('order_items')->insert([
    //[
        //'order_id'   => $order1->id,
       //$fkColumn    => $coffee->id ?? $coffee->item_id,
        //'item_name'  => 'Coffee',
        //'quantity'   => 2,
        //'subtotal'   => $coffee->price * 2,
        //'status'     => 'Pending',
        //'created_at' => now(),
        //'updated_at' => now(),
    //],
    //[
        //'order_id'   => $order1->id,
        //$fkColumn    => $pizza->id ?? $pizza->item_id,
        //'item_name'  => 'Pizza',
        //'quantity'   => 1,
        //'subtotal'   => $pizza->price * 1,
        //'status'     => 'Pending',
        //'created_at' => now(),
        //'updated_at' => now(),
    //],
    //[
        //'order_id'   => $order1->id,
        //$fkColumn    => $pasta->id ?? $pasta->item_id,
        //'item_name'  => 'Pasta',
        //'quantity'   => 1,
        //'subtotal'   => $pasta->price * 1,
        //'status'     => 'Pending',
        //'created_at' => now(),
        //'updated_at' => now(),
    //],
//]);

        // --- ORDER 2: Sandwich, Fries ---
        //DB::table('order_items')->insert([
            //[
                //'order_id'   => $order2->id,
                //$fkColumn    => $sandwich->id ?? $sandwich->item_id,
                //'item_name'  => 'Sandwich',
                //'quantity'   => 2,
                //'subtotal'   => $sandwich->price * 2,
                //'status'     => 'Pending',
                //'created_at' => now(),
                //'updated_at' => now(),
            //],
            //[
                //'order_id'   => $order2->id,
                //$fkColumn    => $fries->id ?? $fries->item_id,
                //'item_name'  => 'Fries',
                //'quantity'   => 1,
                //'subtotal'   => $fries->price * 1,
                //'status'     => 'Pending',
                //'created_at' => now(),
                //'updated_at' => now(),
            //],
        //);

        // --- ORDER 3: Steak, Salad ---
        //DB::table('order_items')->insert([
            //[
                //'order_id'   => $order3->id,
                //$fkColumn    => $steak->id ?? $steak->item_id,
                //'item_name'  => 'Steak',
                //'quantity'   => 1,
                //'subtotal'   => $steak->price * 1,
                //'status'     => 'In Progress',
                //'created_at' => now(),
                //'updated_at' => now(),
            //],
            //[
                //'order_id'   => $order3->id,
                //$fkColumn    => $salad->id ?? $salad->item_id,
                //'item_name'  => 'Salad',
                //'quantity'   => 1,
                //'subtotal'   => $salad->price * 1,
                //'status'     => 'In Progress',
                //'created_at' => now(),
                //'updated_at' => now(),
            //],
        //]);
    //}
//}
