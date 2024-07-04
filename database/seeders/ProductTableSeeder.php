<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Domain\User\Domain\User;
use App\Domain\Category\Domain\Category;
use App\Domain\Tag\Domain\Tag;
use App\Domain\Product\Domain\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $product = new Product();
        $product->title = 'Product №1';
        $product->slug = 'product-1';
        $product->description = 'description';
        $product->keywords = 'keywords';
        $product->media = null;
        $product->price = 16000.00;
        $product->content = 'content';
        $product->status = true;
        $product->views = 953;
        $product->category_id = Category::query()->get('id')[1]->id;
        $product->user_id = User::query()->get('id')[0]->id;
        $product->data = [
            'heading' => 'heading',
            'excerpt' => 'excerpt',
        ];
        $product->save();
        $product->tags()->sync([Tag::query()->get('id')[1]->id]);

        sleep(1);

        $product = new Product();
        $product->title = 'Product №2';
        $product->slug = 'product-2';
        $product->description = 'description';
        $product->keywords = 'keywords';
        $product->media = null;
        $product->price = 22000.00;
        $product->content = 'content';
        $product->status = true;
        $product->views = 735;
        $product->category_id = Category::query()->get('id')[3]->id;
        $product->user_id = User::query()->get('id')[0]->id;
        $product->data = [
            'heading' => 'heading',
            'excerpt' => 'excerpt',
        ];
        $product->save();
        $product->tags()->sync([Tag::query()->get('id')[3]->id]);
    }
}

