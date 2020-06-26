<?php

use Phpmig\Migration\Migration;

use Illuminate\Database\Capsule\Manager as Capsule;

class Breeds extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        Capsule::schema()->create('breeds', function($table)
        {
            $table->increments('id');
            $table->string('query')->unique()->nullable();
            $table->binary('result');
            $table->timestamps();
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Capsule::schema()->drop('breeds');
    }
}