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
        $category = new Category;
        $category->title = 'Веб-разработка';
        $category->slug = 'web-development';
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

        $category = new Category;
        $category->title = 'Маркетинг';
        $category->slug = 'marketing';
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
        
        $category = new Category;
        $category->title = 'SEO-оптимизация';
        $category->slug = 'seo';
        $category->description = 'description.';
        $category->keywords = 'keywords';
        $category->type = 'post';
        $category->status = true;
        $category->media = 'assets/img/no-data.png';
        $category->category_id = null;
        $category->user_id = 1;
        $category->data = null;
        $category->save();
    }
}
