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
            $table->string('advert_title', 150);
			$table->string('advert_seftitle', 200);
            $table->string('advert_user', 200)->comment('elan verən');
            $table->integer('personID')->comment('elanı qəbul edən');
            $table->string('advert_address', 250);
            $table->string('advert_phone', 50);
            $table->string('advert_beginwork', 50);
            $table->string('advert_accessory', 200);
            $table->string('advert_state', 20)->default('waiting');
            $table->text('advert_description');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('adverts');
    }
}
