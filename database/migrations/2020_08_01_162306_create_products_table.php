<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('photo')->nullable();
            $table->longText('content')->nullable();
            $table->decimal('price', 5, 2)->default(0);
            $table->decimal('offer_price', 5, 2)->default(0);
            $table->integer('stock')->default(0);
            $table->date('start_at')->nullable();
            $table->date('end_at')->nullable();
            $table->date('offer_start_at')->nullable();
            $table->date('offer_end_at')->nullable();
            $table->longText('other_data')->nullable();
            $table->string('weight')->nullable();

            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('trade_id')->nullable();
            $table->unsignedBigInteger('manufact_id')->nullable();
            $table->unsignedBigInteger('color_id')->nullable();
            $table->unsignedBigInteger('size_id')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();

            $table->enum('state', ['pending', 'refused', 'active'])->default('pending');
            $table->longText('reason')->nullable();

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
        Schema::dropIfExists('products');
    }
}
