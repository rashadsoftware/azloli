<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MergeTable extends Migration
{

    public function up()
    {
        Schema::create('merges', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_turkish_ci';
            $table->bigIncrements('merge_id');
            $table->string('merge_owner', 60);
            $table->string('merge_user', 60);
        });
    }

    public function down()
    {
        Schema::dropIfExists('merges');
    }
}
