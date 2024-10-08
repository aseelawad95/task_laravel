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
            $table->string('name',200); // اسم المنتج (حتى 200 حرف)
            $table->text('description')->max(50); // وصف المنتج (نص طويل)
            $table->string('image'); // حقل الصورة
            $table->foreignId('seller_id')->constrained('usxers')->onDelete('cascade');
            $table->timestamps(); // timestamps للحفظ الآلي لموعد الإنشاء والتحديث
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
