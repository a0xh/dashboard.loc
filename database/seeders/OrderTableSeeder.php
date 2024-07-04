<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Domain\Order\Domain\Order;
use App\Domain\Product\Domain\Product;
use App\Domain\User\Domain\User;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $order = new Order();
        $order->product_id = Product::query()->get('id')[0]->id;
        $order->user_id = User::query()->get('id')[0]->id;
        $order->quantity = 1;
        $order->status = true;
        $order->data = null;
        $order->save();

        sleep(1);

        $order = new Order();
        $order->product_id = Product::query()->get('id')[1]->id;
        $order->user_id = User::query()->get('id')[1]->id;
        $order->quantity = 1;
        $order->status = false;
        $order->data = null;
        $order->save();
    }
}
