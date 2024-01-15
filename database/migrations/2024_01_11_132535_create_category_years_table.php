<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_years', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('questioncategory_id')->nullable();
            $table->foreign('questioncategory_id')->references('id')->on('questioncategories');
            $table->unsignedBigInteger('timeframe_id')->nullable();
            $table->foreign('timeframe_id')->references('id')->on('timeframes');
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
        Schema::dropIfExists('category_years');
    }
}
