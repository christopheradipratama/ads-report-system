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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('reporter_id')->unsigned();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->string('ticket_id');
            $table->string('title');
            $table->longText('description');
            $table->string('status');
            $table->timestamps();
        });


        Schema::table('reports', function (Blueprint $table) {
            $table->foreign('reporter_id')
                ->references('id')
                ->on('reporters')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};