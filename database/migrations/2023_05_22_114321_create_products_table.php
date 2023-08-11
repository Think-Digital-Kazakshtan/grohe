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
            $table->integer('collection_id');
            $table->string('sku');
            $table->string('title');
            $table->string('slug');
            $table->json('params');
            $table->json('params_detail');
            $table->string('color');
            $table->string('made_in');
            $table->string('warranty');
            $table->text('note');
            $table->bigInteger('quantity')->default(1);
            $table->text('description')->nullable();
            $table->decimal('old_price')->nullable();
            $table->decimal('price');
            $table->boolean('is_active')->default(true);
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
