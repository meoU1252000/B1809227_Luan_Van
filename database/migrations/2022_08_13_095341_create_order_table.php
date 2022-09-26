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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('address_id')->constrained('customer_address')->onDelete('cascade');
            $table->foreignId('staff_id')->constrained('staff')->onDelete('cascade')->nullable();
            $table->foreignId('event_id')->constrained('event')->onDelete('cascade')->nullable();
            $table->dateTime('receive_date');
            $table->string('order_status',255);
            $table->double('total_price');
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
        Schema::dropIfExists('order');
    }
};
