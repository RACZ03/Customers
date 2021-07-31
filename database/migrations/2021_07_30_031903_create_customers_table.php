<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->char('name', 40)->nullable($value = false);
            $table->char('lastName', 40)->nullable($value = true);
            $table->char('dni', 16)->nullable($value = false)->unique();
            $table->char('phoneNumber', 13)->nullable($value = false)->unique();
            $table->boolean('status')->nullable($value = false);

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
        Schema::dropIfExists('customers');
    }
}
