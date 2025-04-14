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
        Schema::create('tb_group', function (Blueprint $table) {
            $table->id();
            $table->string('created_by')->default('admin');
            $table->string('updated_by')->default('admin');
            $table->timestamps();
            $table->string('group');
            $table->string('description');
            $table->tinyInteger('published')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_group');
    }
};
