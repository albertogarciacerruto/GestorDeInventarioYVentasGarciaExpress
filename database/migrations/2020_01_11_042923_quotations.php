<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Quotations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->increments('id');
            $table->Date('date_init');
            $table->Date('date_finish');
            $table->string('quantity')->nullable();
            $table->string('iva')->nullable();
            $table->string('total')->nullable();
            $table->string('status')->default('Por Confirmar');
            $table->string('dolar_value');
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->unsignedInteger('iva_id');
            $table->foreign('iva_id')->references('id')->on('ivas');
            $table->integer('user');
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
        Schema::dropIfExists('quotations');
    }
}
