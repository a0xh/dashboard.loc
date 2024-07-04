<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleTableSeeder::class,
            UserTableSeeder::class,
            PageTableSeeder::class,
            CategoryTableSeeder::class,
            TagTableSeeder::class,
            PostTableSeeder::class,
            ProductTableSeeder::class,
            CommentTableSeeder::class,
            OrderTableSeeder::class,
        ]);
    }
}
