<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicament', function (Blueprint $table) {
            //medicament(id_medicament,Code_medicament,date_expiration,designiation,format,stock_actuel,stock_minimale,prix,id_user)

            $table->id();
            $table->unsignedBigInteger('id_admin');
            $table->foreign('id_admin')->references('id')->on('admin')->onDelete('cascade')->onUpdate('cascade');
            $table->string('code_medicament');
            $table->string('desi');
            $table->string('format');
            $table->string('date_expiration');
            $table->unsignedBigInteger('Stock_Min');
            $table->unsignedBigInteger('Stock_actuel');
            $table->unsignedBigInteger('prix');
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
        Schema::dropIfExists('medicament');
    }
};
