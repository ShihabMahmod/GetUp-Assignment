<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //$this->call(RolesAndPermissionsSeeder::class);
        User::factory()->count(5)->create();
        Category::factory(10)->create();
        Product::factory()->count(50)->create();
        Order::factory()->count(50)->create();
    }
}
