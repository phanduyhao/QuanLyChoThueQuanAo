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
        Schema::create('nhap_khos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_thue')->unsigned()->nullable();
            $table->boolean('trang_thai')->nullable();
            $table->bigInteger('id_nhanvien')->unsigned()->nullable();
            $table->foreign('id_nhanvien')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();

            $table->foreign('id_thue')->references('id')->on('chothues')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhapkhos');
    }
};
