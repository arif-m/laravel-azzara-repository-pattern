<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('created_by')->default('admin');
            $table->string('updated_by')->default('admin');
            $table->timestamps();
            $table->string('name');
            $table->bigInteger('level')->default(1)->unsigned();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('file_path')->nullable();
            $table->string('file_name')->nullable();
            $table->tinyInteger('published')->default(1);

            $table->foreign('level')->references('id')->on('tb_group'); //->onDelete('cascade');
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
};
