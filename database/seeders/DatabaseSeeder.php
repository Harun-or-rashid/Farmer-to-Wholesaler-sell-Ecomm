<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DivisionsTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
        $this->call(UpazilasTableSeeder::class);
        $this->call(UnionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        \App\Models\ProductCategory::factory(10)->create();
    }
}
