<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('stars'); // 1-5
            $table->timestamps();

            $table->unique(['product_id', 'user_id']); // Un usuario solo puede puntuar una vez cada producto
        });
    }

    public function down()
    {
        Schema::dropIfExists('ratings');
    }
}