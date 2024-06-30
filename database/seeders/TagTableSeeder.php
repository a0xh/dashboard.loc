<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Domain\Tag\Domain\Tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $tag = new Tag();
        $tag->title = 'Tag №1';
        $tag->slug = 'tag-1';
        $tag->description = 'description';
        $tag->keywords = 'keywords';
        $tag->media = null;
        $tag->type = 'post';
        $tag->status = true;
        $tag->user_id = 1;
        $tag->data = null;
        $tag->save();

        sleep(1);

        $tag = new Tag();
        $tag->title = 'Tag №2';
        $tag->slug = 'tag-2';
        $tag->description = 'description';
        $tag->keywords = 'keywords';
        $tag->media = null;
        $tag->type = 'product';
        $tag->status = true;
        $tag->user_id = 1;
        $tag->data = null;
        $tag->save();

        sleep(1);
        
        $tag = new Tag();
        $tag->title = 'Tag №3';
        $tag->slug = 'tag-3';
        $tag->description = 'description';
        $tag->keywords = 'keywords';
        $tag->media = null;
        $tag->type = 'post';
        $tag->status = true;
        $tag->user_id = 1;
        $tag->data = null;
        $tag->save();

        sleep(1);
        
        $tag = new Tag();
        $tag->title = 'Tag №4';
        $tag->slug = 'tag-4';
        $tag->description = 'description';
        $tag->keywords = 'keywords';
        $tag->media = null;
        $tag->type = 'product';
        $tag->status = true;
        $tag->user_id = 1;
        $tag->data = null;
        $tag->save();
    }
}
