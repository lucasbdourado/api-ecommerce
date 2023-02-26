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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40);
            $table->string('url_name')->unique();
            $table->text('description')->nullable();
            $table->string('marca', 40)->nullable();
            $table->double('altura', 4, 2);
            $table->double('largura', 4, 2);
            $table->double('comprimento', 4, 2);
            $table->double('peso', 10, 3);
            $table->double('valor', 6, 2);
            $table->unsignedBigInteger('category_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
