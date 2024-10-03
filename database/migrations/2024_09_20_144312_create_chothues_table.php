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
        Schema::create('chothues', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_customer')->unsigned()->nullable();
            $table->bigInteger('id_product')->unsigned()->nullable();
            $table->bigInteger('id_kho')->unsigned()->nullable();
            $table->integer('soluongconlai')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('so_ngay_thue')->nullable();
            $table->decimal('thanh_tien', 10, 2)->nullable();
            $table->decimal('khach_coc', 10, 2)->nullable();
            $table->bigInteger('id_nhanvien')->unsigned()->nullable();
            $table->boolean('Xoa')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_product')->references('id')->on('products')->onDelete('set null');
            $table->foreign('id_nhanvien')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_customer')->references('id')->on('customers')->onDelete('set null');  // Assuming you have a 'khach_hangs' table
            $table->foreign('id_kho')->references('id')->on('khos')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chothues');
    }
};
