<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_parents', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->char('name', 100);
            $table->char('name_en', 100);
            $table->integer('sequence');
            $table->integer('access_menu');
            $table->char('icon', 100);
            $table->char('background', 100);
            $table->text('available_action');
            $table->enum('status', [true,false])->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_parents');
    }
}
