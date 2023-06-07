<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
           $table->string('first_name');
            $table->string('last_name');
            $table->string('user_type')->nullable(true);
            $table->string('email')->unique();
            $table->string('plane_password')->nullable(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('address')->nullable(true);
            $table->string('status')->default('1');
            $table->string('verified')->nullable(true);
            $table->string('is_blocked')->default('0');
            $table->rememberToken();
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
}
