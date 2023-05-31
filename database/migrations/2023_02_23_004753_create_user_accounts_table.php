<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->foreignId('user_id');
            $table->enum('is_super_user', ['N', 'Y'])->default('N');
            $table->enum('user_level', [1,2,3,4,5])->default(5);
            $table->text('address1');
            $table->text('address2');
            $table->bigInteger('phone');
            $table->date('user_login_valid_from');
            $table->date('user_login_valid_thru');
            $table->text('list_access_menu');
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
        Schema::dropIfExists('user_accounts');
    }
}
