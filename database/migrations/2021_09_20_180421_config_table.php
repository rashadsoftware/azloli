<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConfigTable extends Migration
{
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_turkish_ci';
            $table->bigIncrements('config_id');
            $table->string('config_title', 40);
            $table->string('config_logo', 40);
            $table->string('config_favicon', 40);
            $table->string('config_phone', 20);
            $table->string('config_address', 200);
            $table->text('config_description');
            $table->string('config_email', 60);
            $table->string('config_facebook');
            $table->string('config_instagram');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('configs');
    }
}
