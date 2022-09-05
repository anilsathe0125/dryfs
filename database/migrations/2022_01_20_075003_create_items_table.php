<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->default(0)->nullable();
            $table->bigInteger('tax_id')->nullable();
            $table->bigInteger('brand_id')->default(0)->nullable();
            $table->text('name')->nullable();
            $table->text('slug')->nullable();
            $table->string('sku')->nullable();
            $table->text('tags')->nullable();
            $table->text('video')->nullable();
            $table->text('short_details')->nullable();
            $table->text('specification_name')->nullable();
            $table->text('specification_description')->nullable();
            $table->tinyInteger('is_specification')->default(0)->nullable();
            $table->text('details')->nullable();
            $table->text('photo')->nullable();
            $table->double('discount_price')->default(0)->nullable();
            $table->double('previous_price')->default(0)->nullable();
            $table->integer('stock')->default(0)->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->tinyInteger('status')->default(1)->nullable();
            $table->string('is_type')->nullable();
            $table->string('date')->nullable();
            $table->string('item_type')->nullable()->default('normal');
            $table->text('file')->nullable();
            $table->text('link')->nullable();
            $table->enum('file_type', ['file', 'link'])->nullable();
            $table->text('license_name')->nullable();
            $table->text('license_key')->nullable();
            $table->text('thumbnail')->nullable();
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
        Schema::dropIfExists('items');
    }
}
