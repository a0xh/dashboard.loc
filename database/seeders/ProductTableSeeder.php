<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        $product->category_id = 2;
        $product->user_id = 1;
        $product->data = [
            'heading' => 'heading',
            'excerpt' => 'excerpt',
        ];
        $product->save();
        $product->tags()->sync([2]);

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
        $product->category_id = 4;
        $product->user_id = 1;
        $product->data = [
            'heading' => 'heading',
            'excerpt' => 'excerpt',
        ];
        $product->save();
        $product->tags()->sync([4]);
    }
}

