<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('returns', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('order_item_id');
        $table->unsignedBigInteger('user_id');
        $table->text('reason')->nullable();
        $table->string('status')->default('pendiente'); // pendiente, aceptada, rechazada, etc.
        $table->timestamps();

        $table->foreign('order_item_id')->references('id')->on('order_items')->onDelete('cascade');
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
        Schema::dropIfExists('returns');
    }
}
