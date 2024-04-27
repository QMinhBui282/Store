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
        Schema::create('paymentspur', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount');
            $table->foreignId('purchar_id');
            $table->foreignId('user_id');
            $table->timestamps();

            $table->foreign('purchar_id')->references('id')->on('purchars')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paymentspur');
    }
};
