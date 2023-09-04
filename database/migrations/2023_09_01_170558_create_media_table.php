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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('model_type');
            $table->bigInteger('model_id');
            $table->char('uuid');
            $table->string('collection_name');
            $table->string('name');
            $table->string('file_name');
            $table->string('mime_type');
            $table->string('disk');
            $table->string('conversions_disk');
            $table->bigInteger('size');
            $table->longText('manipulations');
            $table->longText('custom_properties');
            $table->longText('generated_conversions');
            $table->longText('responsive_images');
            $table->integer('order_column');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};