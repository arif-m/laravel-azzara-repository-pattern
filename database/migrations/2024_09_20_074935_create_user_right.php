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
        Schema::create('tb_menu', function (Blueprint $table) {
            $table->id();
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
            $table->string('name');
            $table->string('uri');
            $table->string('route');
            $table->string('menu_allowed');
            $table->biginteger('parent_id');
            $table->string('group');
            $table->string('icon');
            $table->integer('sequence');
            $table->tinyInteger('is_visible')->default(0);
            $table->tinyInteger('is_visible_user_right')->default(0);
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
        Schema::dropIfExists('tb_menu');
    }
};
