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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom_user',45);
            $table->string('email',45)->unique();
            $table->mediumText('phrase_secrete');
            $table->string('login',45)->unique();
            $table->string('password',100);
            $table->tinyText('statut');
            $table->boolean('first_connection')->default(true);
            $table->string('telephone',45);
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
        Schema::dropIfExists('users');
    }
};
