<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Domain\User\Domain\User;
use App\Domain\Category\Domain\Category;
use App\Domain\Tag\Domain\Tag;
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
        $post->views = 775;
        $post->category_id = Category::query()->get('id')[0]->id;
        $post->user_id = User::query()->get('id')[0]->id;
        $post->data = [
            'heading' => 'heading',
            'excerpt' => 'excerpt',
        ];
        $post->save();
        $post->tags()->sync([Tag::query()->get('id')[0]->id]);

        sleep(1);

        $post = new Post();
        $post->title = 'Post №2';
        $post->slug = 'post-2';
        $post->description = 'description';
        $post->keywords = 'keywords';
        $post->media = null;
        $post->content = 'content';
        $post->status = true;
        $post->views = 532;
        $post->category_id = Category::query()->get('id')[2]->id;
        $post->user_id = User::query()->get('id')[0]->id;
        $post->data = [
            'heading' => 'heading',
            'excerpt' => 'excerpt',
        ];
        $post->save();
        $post->tags()->sync([Tag::query()->get('id')[2]->id]);
    }
}
