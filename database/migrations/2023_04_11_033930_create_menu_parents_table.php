<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
            $table->char('link_url', 100);
            $table->text('available_action');
            $table->enum('set_label', ['Home','Langganan', 'Halo_Belajar','Halo_Tryout','Setting'])->default('Home');
            $table->enum('status', [true,false])->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('menu_parents')->insert([
            'id' => 1,
            'uuid' => Str::uuid(),
            'name' => 'Beranda',
            'name_en' => 'Dashboard',
            'sequence' => 1,
            'access_menu' => 3,
            'icon' => 'fa fa-home',
            'background' => 'red',
            'link_url' => 'beranda',
            'available_action' => 'insert,view,delete,edit',
            'set_label' => 'Home',
            'status' => true,
        ]);

        DB::table('menu_parents')->insert([
            'id' => 2,
            'uuid' => Str::uuid(),
            'name' => 'Agenda',
            'name_en' => 'Event',
            'sequence' => 1,
            'access_menu' => 3,
            'icon' => 'fa fa-table',
            'background' => 'red',
            'link_url' => 'agenda',
            'available_action' => 'insert,view,delete,edit',
            'set_label' => 'Home',
            'status' => true,
        ]);

        DB::table('menu_parents')->insert([
            'id' => 3,
            'uuid' => Str::uuid(),
            'name' => 'Paket Halo',
            'name_en' => 'Halo Package',
            'sequence' => 1,
            'access_menu' => 3,
            'icon' => 'fa-shopping-cart',
            'background' => 'red',
            'link_url' => 'paket_halo',
            'available_action' => 'insert,view,delete,edit',
            'set_label' => 'Langganan',
            'status' => true,
        ]);
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
