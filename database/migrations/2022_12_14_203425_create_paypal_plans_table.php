<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaypalPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paypal_plans', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('product_id')->nullable();
            $table->string('plan_id')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('plan_price')->nullable();
            $table->string('Currency')->nullable();
            $table->string('interval_count')->nullable();
            $table->string('billing_cycles_period')->nullable();
            $table->string('plan_response')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('paypal_plans');
    }
}
