<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Domain\Page\Domain\Page;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $page = new Page();
        $page->title = 'Home Page';
        $page->slug = 'index';
        $page->description = 'description';
        $page->keywords = 'keywords';
        $page->content = 'content';
        $page->status = true;
        $page->media = null;
        $page->views = 537;
        $page->user_id = 1;
        $page->data = serialize([
            'heading' => 'heading',
            'excerpt' => 'excerpt'
        ]);
        $page->save();
    }
}
