<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Domain\Product\Domain\Product;
use App\Domain\Post\Domain\Post;
use App\Domain\Comment\Domain\Comment;
use App\Domain\User\Domain\User;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $comment = new Comment();
        $comment->type = 'post';
        $comment->user_id = User::query()->get('id')[0]->id;
        $comment->comment_id = null;
        $comment->content = "#1. Test commnet post.";
        $comment->status = true;
        $comment->save();
        $comment->posts()->sync([Post::query()->get('id')[0]->id]);

        sleep(1);

        $comment = new Comment();
        $comment->type = 'post';
        $comment->user_id = User::query()->get('id')[1]->id;
        $comment->comment_id = $comment->query()->get('id')[0]->id;
        $comment->content = "#2. Test child commnet post.";
        $comment->status = true;
        $comment->save();
        $comment->posts()->sync([Post::query()->get('id')[0]->id]);

        sleep(1);

        $comment = new Comment();
        $comment->type = 'product';
        $comment->user_id = User::query()->get('id')[1]->id;
        $comment->comment_id = null;
        $comment->content = "#1. Test commnet product.";
        $comment->status = true;
        $comment->save();
        $comment->products()->sync([Product::query()->get('id')[0]->id]);

        sleep(1);

        $comment = new Comment();
        $comment->type = 'product';
        $comment->user_id = User::query()->get('id')[0]->id;
        $comment->comment_id = $comment->query()->get('id')[2]->id;
        $comment->content = "#2. Test child commnet product.";
        $comment->status = true;
        $comment->save();
        $comment->products()->sync([Product::query()->get('id')[0]->id]);
    }
}
