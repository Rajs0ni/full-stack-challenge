<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_types', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index('title');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->index('uuid')->unique();
            $table->unsignedBigInteger('property_type_id')->nullable();
            $table->string('county')->index('county')->nullable();
            $table->string('country')->index('country')->nullable();
            $table->string('postal_code')->index('postal_code')->nullable();
            $table->string('town')->index('town')->nullable();
            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->string('image_full')->nullable();
            $table->string('image_thumbnail')->nullable();
            $table->decimal('latitude', 10, 7)->index('latitude')->default(0);
            $table->decimal('longitude', 10, 7)->index('longitude')->default(0);
            $table->integer('num_bedrooms')->index('num_bedrooms')->default(0);
            $table->integer('num_bathrooms')->index('num_bathrooms')->default(0);
            $table
                ->decimal('price', 16, 2)
                ->index('price')
                ->nullable();
            $table->string('type')->nullable();
            $table->boolean('is_admin_entry')->index('is_admin_entry')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table
                ->foreign('property_type_id')
                ->references('id')
                ->on('property_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_types');
        Schema::dropIfExists('properties');
    }
}
