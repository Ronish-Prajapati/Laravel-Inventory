<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id(); // This is a unique identifier for the stocks table
        $table->unsignedBigInteger('supplier_id'); // Matches the primary key type of suppliers
        $table->unsignedBigInteger('product_id'); // Assuming product_id is also unsigned big integer
        $table->integer('stock_quantity');
        $table->timestamps();

        // Foreign key constraints
        $table->foreign('supplier_id')->references('user_id')->on('suppliers')->onDelete('cascade');
        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
};
