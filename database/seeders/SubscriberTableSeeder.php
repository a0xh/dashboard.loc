<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subscriber;

class SubscriberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subscriber = new Subscriber();
        $subscriber->email = 'test-true@mail.ru';
        $subscriber->status = 'on';
        $subscriber->ip = '127.0.0.1';
        $subscriber->data = null;
        $subscriber->save();

        sleep(1);
        
        $subscriber = new Subscriber();
        $subscriber->email = 'test-false@mail.ru';
        $subscriber->status = 'off';
        $subscriber->ip = '127.0.0.2';
        $subscriber->data = null;
        $subscriber->save();
    }
}
