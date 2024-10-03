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
        Schema::create('khos', function (Blueprint $table) {
            $table->id();
            $table->integer('title')->nullable();
            $table->bigInteger('id_product')->unsigned()->nullable();
            $table->integer('quantity')->nullable();
            $table->string('desc')->nullable();
            $table->boolean('Xoa')->nullable();
            $table->timestamps();

            $table->foreign('id_product')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khos');
    }
};
