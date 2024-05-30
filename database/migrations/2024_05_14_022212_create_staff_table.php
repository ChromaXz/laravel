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
        Schema::create('staff', function (Blueprint $table) {
            //$table->id();
            //ini contoh membuat table staff menggunakan kode php artisan make:migration create_staff_table
            //ini contoh membuat table nama menggunakan kode php artisan make:migration create_nama_table
            $table->bigIncrements('id');
            $table->char('nip', 5)->unique();
            $table->string('name', 50);
            $table->text('alamat');
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};