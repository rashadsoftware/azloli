<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdvertTable extends Migration
{
    public function up()
    {
        Schema::create('adverts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_turkish_ci';
            $table->bigIncrements('advert_id');
            $table->string('advert_name', 100);
            $table->string('advert_category', 20);
            $table->string('advert_subcategory', 20);
            $table->string('advert_phone', 20);
            $table->text('advert_description', 250);
            $table->string('advert_status', 10)->default('waiting')->comment('active, passive, waiting');
            $table->string('advert_read', 10)->default('unread')->comment('read, unread');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('adverts');
    }
}
