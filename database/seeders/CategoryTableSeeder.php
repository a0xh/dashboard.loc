<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Domain\Category\Domain\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $category = new Category();
        $category->title = 'Category №1';
        $category->slug = 'category-1';
        $category->description = 'description';
        $category->keywords = 'keywords';
        $category->type = 'post';
        $category->status = true;
        $category->media = 'assets/img/no-data.png';
        $category->category_id = null;
        $category->user_id = 1;
        $category->data = null;
        $category->save();

        sleep(1);

        $category = new Category();
        $category->title = 'Category №2';
        $category->slug = 'category-2';
        $category->description = 'description';
        $category->keywords = 'keywords';
        $category->type = 'product';
        $category->status = true;
        $category->media = 'assets/img/no-data.png';
        $category->category_id = 1;
        $category->user_id = 1;
        $category->data = null;
        $category->save();

        sleep(1);
        
        $category = new Category();
        $category->title = 'Category №3';
        $category->slug = 'category-3';
        $category->description = 'description.';
        $category->keywords = 'keywords';
        $category->type = 'post';
        $category->status = true;
        $category->media = 'assets/img/no-data.png';
        $category->category_id = null;
        $category->user_id = 1;
        $category->data = null;
        $category->save();

        sleep(1);
        
        $category = new Category();
        $category->title = 'Category №4';
        $category->slug = 'category-4';
        $category->description = 'description.';
        $category->keywords = 'keywords';
        $category->type = 'product';
        $category->status = true;
        $category->media = 'assets/img/no-data.png';
        $category->category_id = 3;
        $category->user_id = 1;
        $category->data = null;
        $category->save();
    }
}
