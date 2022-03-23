<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tcs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('from_class');
            $table->string('resion');
            $table->string('behaviour');
            $table->string('from_session');
            $table->json('meta')->nullable();
            $table->string('status');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('tcs', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('from_class')->references('id')->on('my_classes')->onDelete('cascade');
           });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tcs');
    }
}
