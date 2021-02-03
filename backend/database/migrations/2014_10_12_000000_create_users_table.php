<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('users')) {
            // テーブルが存在していればリターン
            return;
        }
        
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->string('img')->nullable();
            $table->unsignedBigInteger('age')->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->unsignedBigInteger('history_id')->nullable();
            $table->unsignedBigInteger('language_id')->nullable();

            $table->timestamps();

             // 外部キー制約
             $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
             $table->foreign('history_id')->references('id')->on('histories')->onDelete('cascade');
             $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
