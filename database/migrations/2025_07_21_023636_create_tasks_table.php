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
    Schema::create('tasks', function (Blueprint $table) {
        $table->id(); // id (integer, primary key, auto-increment)
        $table->string('title'); // title (string, max 255)
        $table->text('description')->nullable(); // description (text, nullable)
        $table->boolean('is_completed')->default(false); // is_completed (boolean)
        $table->timestamps(); // created_at dan updated_at (timestamps)
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
