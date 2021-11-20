<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CheckAdvertTable extends Migration
{
    public function up()
    {
        Schema::create('checks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_turkish_ci';
            $table->bigIncrements('check_id');
            $table->string('userID', 100);
            $table->string('advertID', 100);
            $table->string('ownerID', 100);
            $table->string('check_status', 10)->comment('confirm');
            $table->string('check_read', 10)->default('unread')->comment('read, unread');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('checks');
    }
}
