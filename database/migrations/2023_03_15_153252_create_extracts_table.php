<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extracts', function (Blueprint $table) {
            $table->id();
            $table->decimal('dough',9,2);
            $table->decimal('dough_cold',9,2);
            $table->decimal('dough_leftover',9,2);
            $table->decimal('flour',9,2);
            $table->decimal('flour_kg',9,2);
            $table->decimal('tortilla_leftover',9,2);
            $table->date('date');
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
        Schema::dropIfExists('extracts');
    }
}
