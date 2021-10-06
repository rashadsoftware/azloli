<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_turkish_ci';
            $table->bigIncrements('user_id');
            $table->string('user_name', 60);
            $table->string('user_image', 60);
            $table->string('user_email', 100);
            $table->string('user_password', 100);
            $table->string('user_status');
            $table->string('user_state')->default('waiting');
            $table->string('user_ip');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
