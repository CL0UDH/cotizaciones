<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idusr')->unsigned();
            $table->foreign('idusr')->references('id')->on('users');
            $table->integer('idcte')->unsigned();
            $table->foreign('idcte')->references('id')->on('clientes');
            $table->decimal('total', 12, 2);
            $table->boolean('esatdo')->default(1);
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
        Schema::dropIfExists('cotizacions');
    }
}
