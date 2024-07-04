<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->comment('Комментарии');

            $table->uuid('id')->primary();
            $table->text('content')->fulltext();
            $table->boolean('status')->default(false);
            $table->enum('type', ['post', 'product']);
            $table->foreignUuid('comment_id')->nullable()->index();
            $table->foreignUuid('user_id')->index();
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
        Schema::dropIfExists('comments');
    }
};
