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
        Schema::create('report_trackers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('report_id')->unsigned();
            $table->string('status');
            $table->text('note');
            $table->timestamps();
        });

        Schema::table('report_trackers', function (Blueprint $table) {
            $table->foreign('report_id')
                ->references('id')
                ->on('reports')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');

            $table->foreign('user_id')
                ->references('id')
                ->on('reporters')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_trackers');
    }
};