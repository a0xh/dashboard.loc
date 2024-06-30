<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->comment('Посты');
            
            $table->smallIncrements('id');
            $table->string('title', 65);
            $table->string('slug', 65)->unique();
            $table->string('description', 200)->nullable();
            $table->string('keywords', 200)->nullable();
            $table->string('media', 255)->nullable();
            $table->text('content')->nullable()->fulltext();
            $table->boolean('status')->default(false);
            $table->unsignedSmallInteger('category_id')->nullable()->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->unsignedSmallInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('data')->nullable()->comment('Доп. данные');
            $table->timestamps();

            $table->index(['created_at']);
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
