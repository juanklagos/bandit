<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('returnCode')->nullable();
            $table->string('bankURL',900)->nullable();
            $table->string('trazabilityCode')->nullable();
            $table->string('transactionCycle')->nullable();
            $table->integer('transactionID')->nullable();
            $table->string('transactionState')->nullable();
            $table->string('sessionID')->nullable();
            $table->string('bankCurrency')->nullable();
            $table->float('bankFactor')->nullable();
            $table->integer('responseCode')->nullable();
            $table->string('responseReasonCode')->nullable();
            $table->string('responseReasonText')->nullable();
            $table->string('reference')->nullable();
            $table->string('requestDate')->nullable();
            $table->string('bankProcessDate')->nullable();
            $table->integer('onTest')->nullable();
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
        Schema::dropIfExists('transacciones');
    }
}
