<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTracesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('traces')) {
            // テーブルが存在していればリターン
            return;
        }
        Schema::create('traces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_language_id');
            $table->string('img')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->string('content')->nullable();
            $table->timestamps();

            // 外部キー制約
            $table->foreign('user_language_id')->references('id')->on('user_languages')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('traces');
    }
}
