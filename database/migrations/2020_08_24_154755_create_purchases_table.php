<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity')->default(1);
            $table->enum('status', ['ordered', 'pending', 'received']);

            $table->decimal('purchase_price', 22, 4);
            $table->decimal('discount', 22, 4)->default(0);
            $table->decimal('tax', 22, 4)->default(0);
            $table->string('coupon')->nullable();
            $table->decimal('total_price', 22, 4)->default(0);
            $table->enum('payment_type', ['cash', 'visa', 'mastercard'])->default('cash');

            $table->enum('payment_status', ['paid', 'due'])->default('paid');

            $table->decimal('payment_price', 22, 4)->default(0);
            $table->date('submit_time')->nullable();
            $table->date('delivery_time')->nullable();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

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
        Schema::dropIfExists('purchases');
    }
}
