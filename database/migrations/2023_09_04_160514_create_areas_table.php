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
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->integer('allowed')->default(1);
            $table->string('name');
            $table->date('days');
            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedBigInteger('condominium_id');
            $table->timestamps();

            $table->foreign('condominium_id')->references('id')->on('condominiums')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('areas', function (Blueprint $table) {
            $table->dropForeign(['condominium_id']);
        });

        Schema::dropIfExists('areas');
    }
};
