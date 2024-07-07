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
        Schema::create('settings', function (Blueprint $table) {
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->comment('Настройки');

            $table->uuid('id')->primary();
            $table->string('key', 45)->unique()->index();
            $table->json('data')->nullable()->comment('Доп. данные');

            $table->timestampTz('created_at')->nullable();
            $table->unsignedSmallInteger('created_by')->nullable();
            $table->timestampTz('updated_at')->nullable();
            $table->unsignedSmallInteger('updated_by')->nullable();
            $table->timestampTz('deleted_at')->nullable();
            $table->unsignedSmallInteger('deleted_by')->nullable();
            $table->boolean('is_deleted')->default(false);
            
            $table->engine('InnoDB');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
