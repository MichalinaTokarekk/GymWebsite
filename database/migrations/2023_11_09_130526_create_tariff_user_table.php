<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tariff_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tariff_id');
            $table->softDeletes();
            $table->string('name');
            $table->string('type');
            $table->integer('qty');
            $table->date('data_rozpoczecia')->default(now()->toDateString()); 
            $table->integer('number'); //ilość dni dla okresowych karnetów ile ważny 
            $table->date('data_zakonczenia')->nullable(); //data wygaśnięcia karnetu
            $table->timestamps();

            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('tariff_id')->references('id')->on('tariffs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tariff_user');
    }
};
