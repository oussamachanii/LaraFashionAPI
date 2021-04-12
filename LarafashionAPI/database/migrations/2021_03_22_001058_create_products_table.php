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
            // $table->string('title')->unique();
            $table->string('title')->unique();
            $table->string('description');
            $table->decimal('price',8,2);
            $table->Integer('quantity')->nullable()->default(0);
            $table->Integer('shipping')->nullable()->default(0);
            $table->tinyInteger('sex')->default(2);
            // $table->tinyInteger('rating')->default(0);
            $table->bigInteger('views')->nullable()->default(0);
            $table->integer('discount')->nullable()->default(0);
            $table->date('discount_start_date')->nullable();
            $table->date('discount_end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('category_id')->nullable()
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
