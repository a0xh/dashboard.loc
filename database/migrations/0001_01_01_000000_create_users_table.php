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
        Schema::create('users', function (Blueprint $table) {
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->comment('Пользователи');

            $table->uuid('id')->primary();
            $table->string('media', 255)->nullable();
            $table->string('first_name', 44);
            $table->string('last_name', 44)->nullable();
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255);
            $table->boolean('status')->nullable()->default(false);
            $table->json('data')->nullable();
            $table->rememberToken();

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

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->string('email')->primary();
            $table->string('token');
            $table->timestampTz('created_at')->nullable();

            $table->engine('InnoDB');
        });
        
        Schema::create('sessions', function (Blueprint $table) {
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');
            
            $table->string('id')->primary();
            $table->foreignUuid('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
            
            $table->engine('InnoDB');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
