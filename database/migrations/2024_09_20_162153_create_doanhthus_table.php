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
        Schema::create('doanhthus', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_kho')->unsigned()->nullable();
            $table->unsignedBigInteger('id_chothue')->nullable();
            $table->foreign('id_chothue')->references('id')->on('chothues')->onDelete('set null');
            $table->unsignedBigInteger('id_kho')->nullable();
            $table->foreign('id_kho')->references('id')->on('khos')->onDelete('set null');
            $table->string('doanh_thu_thuc_te')->nullable();
            $table->string('doanh_thu_du_kien')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doanhthus');
    }
};
