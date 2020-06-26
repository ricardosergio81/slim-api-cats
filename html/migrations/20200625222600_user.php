<?php

use Phpmig\Migration\Migration as Migration;
use Illuminate\Database\Capsule\Manager as Capsule;
use rs81\Models\Users as Users;

class User extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        Capsule::schema()->create('users', function($table)
        {
            $table->increments('id');
            $table->string('username')->unique()->nullable();
            $table->string('password');
            $table->string('email');
            $table->timestamps();
        });

        $array = array(
            array(
                'username'  => 'admin',
                'password'  => '$2y$10$Ceps4IHTpzNlWC93fmrpgeEUIOPPn9Bob7KusVuZe6U3wFMqjUuEm',
                'email'     => 'admin@rs81.com',
            )
        );
        Users::insert($array);
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Capsule::schema()->drop('users');
    }
}