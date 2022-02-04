<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->smallInteger('rooms');
            $table->smallInteger('bedrooms');
            $table->smallInteger('bathrooms');
            $table->smallInteger('parking')->nullable()->default(0);
            $table->decimal('area', 12, 2);
            $table->decimal('value', 12, 2);
            $table->text('description');
            $table->boolean('rented')->default(0);
            $table->boolean('sold')->default(0);
            $table->boolean('reserved')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('usage_id');
            $table->unsignedInteger('category_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('usage_id')->references('id')->on('usages')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('realties');
    }
}
