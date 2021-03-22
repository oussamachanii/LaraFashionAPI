<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /* *
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description');
            $table->integer('price')->nullable();
            $table->Integer('shipping')->nullable();
            $table->tinyInteger('sex')->default(2);
            // $table->tinyInteger('rating')->default(0);
            $table->bigInteger('views')->nullable();
            $table->integer('discount')->nullable();
            $table->date('discount_start_date')->nullable();
            $table->date('discount_end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('category_id')
            ->nullOnDelete()
            ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
