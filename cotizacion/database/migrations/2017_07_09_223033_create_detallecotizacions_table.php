<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallecotizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detallecotizacions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idcotizacion')->unsigned();
            $table->foreign('idcotizacion')->references('id')->on('cotizacions');
            $table->integer('idprod')->unsigned();
            $table->foreign('idprod')->references('id')->on('productos');
            $table->integer('cantidad');
            $table->decimal('importe',12,2);
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
        Schema::dropIfExists('detallecotizacions');
    }
}
