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
        Schema::create('tags', function (Blueprint $table) {
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->comment('Теги');

            $table->uuid('id')->primary();
            $table->string('title', 65);
            $table->string('slug', 65)->unique();
            $table->string('description', 200)->nullable();
            $table->string('keywords', 200)->nullable();
            $table->string('media', 255)->nullable();
            $table->enum('type', ['post', 'product']);
            $table->boolean('status')->default(false);
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->json('data')->nullable()->comment('Доп. данные');

            $table->timestampTz('created_at')->nullable();
            $table->unsignedSmallInteger('created_by')->nullable();
            $table->timestampTz('updated_at')->nullable();
            $table->unsignedSmallInteger('updated_by')->nullable();
            $table->timestampTz('deleted_at')->nullable();
            $table->unsignedSmallInteger('deleted_by')->nullable();
            $table->boolean('is_deleted')->default(false);

            $table->index('created_at');
            $table->engine('InnoDB');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
