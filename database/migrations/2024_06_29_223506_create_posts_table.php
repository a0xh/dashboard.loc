<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $connection = 'mysql';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->comment('Посты');
            
            $table->uuid('id')->primary();
            $table->string('title', 65);
            $table->string('slug', 65)->unique();
            $table->string('description', 200)->nullable();
            $table->string('keywords', 200)->nullable();
            $table->string('media', 255)->nullable();
            $table->text('content')->nullable()->fulltext();
            $table->boolean('status')->default(false);
            $table->mediumInteger('views')->unsigned()->nullable();
            $table->foreignUuid('category_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->json('data')->nullable()->comment('Доп. данные');
            $table->timestampsTz(precision: 0);

            $table->index('created_at');
            $table->engine('InnoDB');
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
