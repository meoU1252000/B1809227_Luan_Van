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
        Schema::create('product_comment', function (Blueprint $table) {
            $table->id();
            $table->integer('comment_parent');
            $table->foreignId('product_id')->constrained('product')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customer')->onDelete('cascade')->nullable();
            $table->foreignId('staff_id')->constrained('staff')->onDelete('cascade')->nullable();
            $table->string('comment_content',255);
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
        Schema::dropIfExists('product_comment');
    }
};
