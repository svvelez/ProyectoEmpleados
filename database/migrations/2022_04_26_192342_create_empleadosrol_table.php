<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosrolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleadosrol', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empleado_id');
            $table->unsignedBigInteger('rol_id');

            $table->foreign('empleado_id')
            ->references('id')
            ->on('empleados')
            ->onDelete('cascade')
            ->onUpdate('cascade');


            $table->foreign('rol_id')
            ->references('id')
            ->on('roles')
            ->onDelete('cascade')
            ->onUpdate('cascade');



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
        Schema::dropIfExists('empleadosrol');
    }
}
