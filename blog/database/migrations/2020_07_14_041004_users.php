<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  Schema::create('users', function(Blueprint $table)
        // {
        //     $table->increments('id');
        //     $table->string('email');
        //     $table->string('name');
        //     $table->string('password');
        //     $table->tinyInteger('role_id')->nullable();
        //     $table->timestamps();
        // });
        // \App\Models\User::create
        // ([
        //     'email' => 'test@grooo.vn',
        //     'name' => 'Test Administrator',
        //     'password' => \Illuminate\Support\Facades\Hash::make('12345678'),
        //     'role_id' => 1
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
