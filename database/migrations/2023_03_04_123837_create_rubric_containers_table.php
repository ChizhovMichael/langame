<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRubricContainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rubric_containers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rubric_id')->unsigned();
            $table->bigInteger('parent_id')->unsigned()->nullable();

            $table->foreign('rubric_id')->references('id')->on('rubrics')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('parent_id')->references('id')->on('rubrics')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rubric_containers');
    }
}
