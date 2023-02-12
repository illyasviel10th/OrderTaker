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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('CustomerID');
            $table->date('DateOfDelivery');
            $table->string('Status');
            $table->decimal('AmountDue');
            $table->date('DateCreated');
            $table->timestamps();
            $table->string('CreatedBy');
            $table->string('UserID');
            $table->boolean('IsActive');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_orders');
    }
};
