<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->decimal('unit_price',9,2);
            $table->string('unit');
            $table->string('image')->nullable();
            $table->foreignId('branch_id') // UNSIGNED BIG INT
                    ->constrained()
                    ->nullable();
            $table->foreignId('store_id') // UNSIGNED BIG INT
                    ->constrained()
                    ->nullable();
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
        Schema::dropIfExists('products');
    }
}
