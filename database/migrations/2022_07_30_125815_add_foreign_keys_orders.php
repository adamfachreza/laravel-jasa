<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('freelancer_id','fk_order_to_users1')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('buyer_id','fk_order_to_users2')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('service_id','fk_orders_to_services')->references('id')->on('services')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('order_status_id','fk_order_to_order_status')->references('id')->on('order_statuses')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('fk_order_to_order_status');
            $table->dropForeign('fk_order_to_users1');
            $table->dropForeign('fk_order_to_users2');
            $table->dropForeign('fk_orders_to_services');
        });
    }
}
