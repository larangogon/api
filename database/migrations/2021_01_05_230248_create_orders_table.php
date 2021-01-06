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
            $table->string('status')->default(\App\Constants\Orders::PENDING);
            $table->string('description');
            $table->string('reference');
            $table->string('processUrl')->nullable();
            $table->string('returnUrl')->nullable();
            $table->string('internalReference')->nullable();
            $table->string('requestId')->nullable();
            $table->float('amount');
            $table->date('expiration')->nullable();
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
