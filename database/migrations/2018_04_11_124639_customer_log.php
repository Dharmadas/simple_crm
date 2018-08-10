<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomerLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20)->nullable();;
            $table->string('email', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->unsignedInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_logs');
    }
}
