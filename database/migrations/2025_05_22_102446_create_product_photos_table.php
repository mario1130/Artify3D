<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPhotosTable extends Migration
{
    public function up()
    {
        Schema::create('product_photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); // Clave foránea
            $table->string('photo_url'); // URL de la foto
            $table->boolean('is_main')->default(false); // Indicador de foto principal
            $table->integer('order')->nullable()->after('is_main');
            $table->timestamps();

            // Relación con la tabla products
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_photos');
    }
}