<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Domain\Comment\Domain\Comment;

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
        $comment->user_id = 1;
        $comment->comment_id = null;
        $comment->content = "#1. Test commnet post.";
        $comment->status = true;
        $comment->save();
        $comment->posts()->sync([1]);

        sleep(1);

        $comment = new Comment();
        $comment->type = 'post';
        $comment->user_id = 2;
        $comment->comment_id = 1;
        $comment->content = "#2. Test child commnet post.";
        $comment->status = true;
        $comment->save();
        $comment->posts()->sync([1]);

        sleep(1);

        $comment = new Comment();
        $comment->type = 'product';
        $comment->user_id = 2;
        $comment->comment_id = null;
        $comment->content = "#1. Test commnet product.";
        $comment->status = true;
        $comment->save();
        $comment->products()->sync([1]);

        sleep(1);

        $comment = new Comment();
        $comment->type = 'product';
        $comment->user_id = 1;
        $comment->comment_id = 3;
        $comment->content = "#2. Test child commnet product.";
        $comment->status = true;
        $comment->save();
        $comment->products()->sync([1]);
    }
}
