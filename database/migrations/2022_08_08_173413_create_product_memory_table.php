<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_memory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('memory_id')->constrained('memory')->onDelete('cascade');
            $table->foreignId('product_filter_id')->constrained('product_filter_by_color')->onDelete('cascade');
            $table->integer('product_number')->default(0);
            $table->integer('product_sold')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_memory');
    }
};
