<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Domain\Subscriber\Domain\Subscriber;

class SubscriberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subscriber = new Subscriber();
        $subscriber->email = 'test-true@mail.ru';
        $subscriber->status = true;
        $subscriber->data = null;
        $subscriber->save();

        sleep(1);
        
        $subscriber = new Subscriber();
        $subscriber->email = 'test-false@mail.ru';
        $subscriber->status = false;
        $subscriber->data = null;
        $subscriber->save();
    }
}
