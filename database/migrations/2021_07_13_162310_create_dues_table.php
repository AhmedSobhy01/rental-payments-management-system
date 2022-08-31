<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dues', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->integer('paid_amount')->default(0);
            $table->integer('discount')->default(0);
            $table->text('note')->nullable();
            $table->unsignedBigInteger('due_category_id');
            $table->unsignedBigInteger('tenant_id');
            $table->timestamps();

            $table->foreign('due_category_id')->references('id')->on('due_categories')->cascadeOnDelete();
            $table->foreign('tenant_id')->references('id')->on('tenants')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dues');
    }
}