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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->integer('ID_stanok');
            $table->text('RFID');
            $table->integer('Count')->nullable();
            $table->string('State');
            $table->float('Condition')->nullable()->default(100);
            $table->integer('worktime')->default(0);
            $table->text('Purpose')->nullable();
            $table->text('Country')->nullable();
            $table->string('Authenticity')->nullable();
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
