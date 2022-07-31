<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('domain')->nullable()->comment('域名');
            $table->text('refer')->nullable()->comment('外链地址');
            $table->string('ip_address')->nullable()->comment('IP');
            $table->tinyInteger('click_type')->nullable()->comment('1 浏览，2 按钮1，3 按钮2');
            $table->string('date')->nullable()->comment('日期');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visits');
    }
}
