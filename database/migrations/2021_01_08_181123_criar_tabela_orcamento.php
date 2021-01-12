<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaOrcamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orcamentos', function(Blueprint $table){
            $table->increments('id');
            $table->string("codigo");
            $table->string("cliente");
            $table->string("data");
            $table->string("hora");
            $table->string("vendedor");
            $table->string("valor");
            $table->string("descricao");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orcamentos');
    }
}
