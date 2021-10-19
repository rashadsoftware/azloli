<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MailTable extends Migration
{
    public function up()
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_turkish_ci';
            $table->bigIncrements('mail_id');
            $table->string('mail_user', 100);
            $table->string('mail_email', 180);
            $table->string('mail_phone', 100);
            $table->string('mail_theme')->comment('Mövzu başlıqları yerləşir');
            $table->text('mail_text');
            $table->string('mail_read', 10)->default('unread')->comment('read, unread');
            $table->string('mail_path', 15)->default('inbox');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mails');
    }
}
