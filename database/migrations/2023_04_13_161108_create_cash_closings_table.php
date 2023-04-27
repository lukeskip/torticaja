<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashClosingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_closings', function (Blueprint $table) {
            $table->id();
            $table->decimal('dough',9,2);
            $table->decimal('dough_cold',9,2);
            $table->decimal('dough_leftover',9,2);
            $table->decimal('flour',9,2);
            $table->decimal('tortilla_leftover',9,2);
            $table->decimal('gas', 10, 2)->default(0);
            $table->decimal('cash', 10, 2)->default(0);
            $table->unsignedBigInteger('branch_id');
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
        Schema::dropIfExists('cash_closings');
    }
}
