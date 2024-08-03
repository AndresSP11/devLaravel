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
        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            /* Se puede definir el constrained en la parte para poder llevarlo ala tabla de users, para le migrate */
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            /* La referencia la va obtener del contrained de users, esto le permite obtener esos valores
            necesarios. */
            /* En este cso tambine va almacenar la parte del id_usuario solo que con otro nombre */
            $table->foreignId('follower_id')->constrained('users')->onDelete('cascade');

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
        Schema::dropIfExists('followers');
    }
};
