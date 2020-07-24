<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableInvoicesDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('invoices_id')->index();
            $table->unsignedBigInteger('product_id')->index();
            $table->unsignedInteger('quantity');
            $table->decimal('total_price');
            $table->foreign('invoices_id')->references('id')->on('invoices')->onDelete('cascade');
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
        Schema::dropIfExists('invoices_detail');
    }
}
