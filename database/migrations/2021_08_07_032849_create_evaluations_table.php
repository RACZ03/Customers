<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->integer('idUser')->unsigned();
            $table->dateTime('startDate')->nullable($value = false);
            $table->dateTime('endDate')->nullable($value = false);
            $table->tinyInteger('score')->nullable($value = false);
            $table->decimal('bond', 8, 2)->nullable($value = false);
            $table->boolean('status')->nullable($value = false);
            
            $table->foreign('idUser')->references('id')->on('customers');
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
        Schema::dropIfExists('evaluations');
    }
}
