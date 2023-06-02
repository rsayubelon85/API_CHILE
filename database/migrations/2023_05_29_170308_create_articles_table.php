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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('price');
            $table->integer('availability')->default(0);
            $table->string('tags');
            $table->text('description');
            $table->text('add_information');
            $table->integer('star_rating');
            $table->bigInteger('sku');
            $table->unsignedBigInteger('categorie_id');
            $table->timestamps();


            $table->foreign('categorie_id')->references('id')->on('categories')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
