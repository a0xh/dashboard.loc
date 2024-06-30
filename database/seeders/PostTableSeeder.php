<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Domain\Post\Domain\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $post = new Post();
        $post->title = 'Post №1';
        $post->slug = 'post-1';
        $post->description = 'description';
        $post->keywords = 'keywords';
        $post->media = null;
        $post->content = 'content';
        $post->status = true;
        $post->category_id = 1;
        $post->user_id = 1;
        $post->data = null;
        $post->save();
        $post->tags()->sync([1]);

        sleep(1);

        $post = new Post();
        $post->title = 'Post №1';
        $post->slug = 'post-2';
        $post->description = 'description';
        $post->keywords = 'keywords';
        $post->media = null;
        $post->content = 'content';
        $post->status = true;
        $post->category_id = 3;
        $post->user_id = 1;
        $post->data = null;
        $post->save();
        $post->tags()->sync([3]);
    }
}
