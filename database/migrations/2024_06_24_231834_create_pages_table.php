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
        Schema::create('pages', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->comment('Страницы');

            $table->uuid('id')->primary();
            $table->string('title', 65);
            $table->string('slug', 65)->unique();
            $table->string('description', 200)->nullable();
            $table->string('keywords', 200)->nullable();
            $table->string('media', 255)->nullable();
            $table->mediumInteger('views')->unsigned()->nullable();
            $table->text('content')->fulltext()->nullable();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('pages');
    }
};
