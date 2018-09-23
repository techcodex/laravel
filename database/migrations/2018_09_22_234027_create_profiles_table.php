<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('profile_id');
            $table->integer('user_id');
            $table->string('first_name',150)->nullable();
            $table->string('middle_name',150)->nullable();
            $table->string('last_name',150)->nullable();
            $table->string('contact_no',13)->nullable();
            $table->string('gender',6)->nullable();
            $table->text('address')->nullable();
            $table->text('profile_image')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('city_id')->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
