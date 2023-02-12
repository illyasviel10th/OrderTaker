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
        Schema::create('skus', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('Code');
            $table->string('UnitPrice');
            $table->date('DateCreated');
            $table->string('CreatedBy');
            $table->timestamps();
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
        Schema::dropIfExists('skus');
    }
};
