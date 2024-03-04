<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTask extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   //criação da tabela tasks e foreign para users
        Schema::create("tasks",function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("name_task",50);
            $table->date("date_limit_task");
            $table->string("description_task",500);
            $table->timestamps();
            $table->foreign("user_id")->references("id")->on("users")->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("tasks",function(Blueprint $table){
            $table->dropForeign("tasks_user_id_foreign");
        });

        Schema::drop("tasks");
    }
}
