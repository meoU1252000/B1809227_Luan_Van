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
        Schema::create('wards', function (Blueprint $table) {
            $table->string('code',20)->primaryKey();
            $table->string('district_code')->references('code')->on('district')->onDelete('cascade');
            $table->foreignId('administrative_unit_id')->constrained('administrative_units')->onDelete('cascade');
            $table->string('name',255);
            $table->string('name_en',255);
            $table->string('full_name',255);
            $table->string('full_name_en',255);
            $table->string('code_name',255);
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
        Schema::dropIfExists('wards');
    }
};
