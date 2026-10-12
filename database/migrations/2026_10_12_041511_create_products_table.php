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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('content');
            $table->integer('category_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->string('img');
            $table->double('price')->unsigned()->default(0);
            $table->double('old_price')->unsigned()->default(0); 
            $table->tinyInteger('hit')->unsigned()->default(0); 
            $table->tinyInteger('sale')->unsigned()->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
