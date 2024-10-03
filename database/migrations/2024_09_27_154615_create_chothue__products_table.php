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
        Schema::create('chothue_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_chothue')->unsigned()->nullable();
            $table->bigInteger('id_product_theokho')->unsigned()->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('thanh_tien', 10, 2)->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_product_theokho')->references('id')->on('khos')->onDelete('set null');
            $table->foreign('id_chothue')->references('id')->on('chothues')->onDelete('set null');  // Assuming you have a 'khach_hangs' table
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chothue__products');
    }
};
