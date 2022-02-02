<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->unsigned();
            $table->string("user_name");
            $table->string("user_email");
            $table->string("user_phone")->nullable();

            $table->tinyInteger("status"); // 0 = pendiente, 1 = preparando, 2 = enviado, 3 = entregado, 99 = cancelado
            $table->boolean("paid")->default(false);

            $table->double("total", 8, 2);
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
        Schema::dropIfExists('orders');
    }
}
