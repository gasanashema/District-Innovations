<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyMarkingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('markings', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['answer_id']);

            // Drop the existing column
            $table->dropColumn('answer_id');

            // Add new columns
            $table->unsignedBigInteger('practice_id');
            $table->foreign('practice_id')->references('id')->on('practices');

            $table->unsignedBigInteger('markingcriteria_id');
            $table->foreign('markingcriteria_id')->references('id')->on('marking_criterias');

            $table->text('comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('markings', function (Blueprint $table) {
            // Reverse the changes in the 'up' method
            $table->dropForeign(['practice_id']);
            $table->dropColumn('practice_id');

            $table->dropForeign(['markingcriteria_id']);
            $table->dropColumn('markingcriteria_id');

            $table->dropColumn('comment');
        });
    }
}
