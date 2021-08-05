<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->string('phone')->after('password')->nullable();
          $table->string('address')->after('password')->nullable();
          $table->unsignedBigInteger('country_id')->after("address")->nullable();
          $table->string('avatar')->after('country_id')->nullable();
          $table->integer('level')->after("avatar")->default(0)->comment("1:admin 0:customer");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            //
        });
    }
}
