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
            $table->string('product_name')->nullable();
            $table->bigInteger('cate_id')->unsigned()->nullable();
            $table->string('size')->nullable();
            $table->text('image')->nullable();
            $table->decimal('price_1_day', 8, 2)->nullable();
            $table->integer('quantity_origin')->nullable();
            $table->boolean('Xoa')->nullable();
            $table->timestamps();

            $table->foreign('cate_id')->references('id')->on('categories')->onDelete('cascade');
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
