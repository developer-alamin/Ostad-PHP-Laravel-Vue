<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Product name
            $table->decimal('price', 10, 2); // Product price
            $table->integer('stock')->default(0); // Stock quantity
            $table->string('sku')->unique(); // Unique product SKU
            $table->string('image')->nullable(); // Image URL or path
            $table->boolean('status')->default(true); // Active/inactive status
            $table->string('short_description')->nullable();
            $table->string('address')->nullable();
            $table->char('phone')->nullable();
            $table->char('email')->nullable();
            $table->char('website')->nullable();
            $table->text('description')->nullable(); // Product description
            
            $table->unsignedBigInteger('category_id')->nullable(); // Foreign key for category
            $table->unsignedBigInteger('brand_id')->nullable(); // Supplier (optional)
            
             // Set null on delete for category or supplier
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
              // Set null on delete for category or supplier
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');


            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
            ->useCurrent()
            ->useCurrentOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
