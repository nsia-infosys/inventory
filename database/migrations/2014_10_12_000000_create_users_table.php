<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // password is secret
        DB::table('users')->insert(array(
            array(
                'id' => 1,
                'name' => 'Pardess',
                'email' => 'pardess@nsia.gov.af',
                'password' => '$2y$10$XSo/qPZN4CjxA24nU8aPH.P4rvW3I2F9/dl8ESbWPrZQ8GLAdPDJ2',
                'created_at' => '2019-03-26 06:43:25',
                'updated_at' => '2019-03-26 06:43:25'
            ),
            array(
                'id' => 2,
                'name' => 'IT',
                'email' => 'it@nsia.gov.af',
                'password' => '$2y$10$XSo/qPZN4CjxA24nU8aPH.P4rvW3I2F9/dl8ESbWPrZQ8GLAdPDJ2',
                'created_at' => '2019-03-26 06:43:25',
                'updated_at' => '2019-03-26 06:43:25'
            )
        ));
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
}
